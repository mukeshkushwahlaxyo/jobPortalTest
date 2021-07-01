<?php
namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Common\Authorizable;
use App\Http\Controllers\Controller;
use App\Repositories\Inventory\InventoryRepository;
use App\Http\Requests\Validations\AddInventoryRequest;
use App\Http\Requests\Validations\ProductSearchRequest;
use App\Http\Requests\Validations\CreateInventoryRequest;
use App\Http\Requests\Validations\UpdateInventoryRequest;
use App\Http\Requests\Validations\CreateInventoryWithVariantRequest;
use App\InventoryCustomise;
use Yajra\DataTables\DataTables;
use Session;

class InventoryController extends Controller
{
    use Authorizable;

    private $model;

    private $inventory;

    /**
     * construct
     */
    public function __construct(InventoryRepository $inventory)
    {
        parent::__construct();

        $this->model = trans('app.model.inventory');

        $this->inventory = $inventory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$inventories = $this->inventory->all();
        Session::put('onForm',false);
        $trashes = $this->inventory->trashOnly();
        return view('admin.inventory.index', compact('trashes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function setVariant(AddInventoryRequest $request, $product_id)
    {
        return view('admin.inventory._set_variant', compact('product_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(AddInventoryRequest $request, $id)
    {
        Session::put('onForm',false);
         Session::remove('invoiceId');
        if (! $request->user()->shop->canAddMoreInventory()) {
            return redirect()->route('admin.stock.inventory.index')
            ->with('error', trans('messages.cant_add_more_inventory'));
        }

        $inInventory = $this->inventory->checkInventoryExist($id);

        if ($inInventory) {
            return redirect()->route('admin.stock.inventory.edit', $inInventory->id)
            ->with('warning', trans('messages.inventory_exist'));
        }

        $product = $this->inventory->findProduct($id);
        $attributesCustom = $this->inventory->getAllAttribute(2);
        // dd($attributesCustom);

        return view('admin.inventory.create', compact('product','attributesCustom'));
    }

    public function addWithVariant(AddInventoryRequest $request)
    {
        
        $id = $request->product_id;
        Session::put('onForm',true);
        if (! $request->user()->shop->canAddMoreInventory()) {
            return redirect()->route('admin.stock.inventory.index')
            ->with('error', trans('messages.cant_add_more_inventory'));
        }

        $variants = $this->inventory->confirmAttributes($request->except('_token'));

        $combinations = generate_combinations($variants);

        $attributes = $this->inventory->getAttributeList(array_keys($variants));

        $product = $this->inventory->findProduct($id);
        $variantUpdate = $this->inventory->getVariants(session('invoiceId'));

        if(count($combinations[0]) ===  0 ){
            return '';
        }
      
        return view('admin.inventory.createWithVariant', compact('combinations', 'attributes', 'product','variantUpdate'));
    }

    /**
     * Add a product to inventory.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateInventoryRequest $request)
    {
        // dd($request); 
      
        $this->authorize('create', \App\Inventory::class); // Check permission

        $inventory = $this->inventory->store($request);
         Session::put('inventry_id',$inventory->id);
        // dd($inventory);
        Session::put('invoiceId',$inventory->id);

        $request->session()->flash('success', trans('messages.created', ['model' => $this->model]));

        return response()->json($this->getJsonParams($inventory));
    }

    /**
     * Add inventory with variants.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeWithVariant(CreateInventoryWithVariantRequest $request)
    {
        $this->inventory->storeWithVariant($request);

        return redirect()->back()->with('success', trans('messages.created', ['model' => $this->model]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inventory = $this->inventory->find($id);

        return view('admin.inventory._show', compact('inventory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //this is inventoryid
        Session::put('invoiceId',$id);
        $inventory = $this->inventory->find($id);
        $product = $this->inventory->findProduct($inventory->product_id);
      
        $preview = $inventory->previewImages();
        $attributesCustom = $this->inventory->getAllAttribute(2);

        return view('admin.inventory.edit', compact('inventory', 'product','attributesCustom' ,'preview'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editQtt($id)
    {
        $inventory = $this->inventory->find($id);

        $this->authorize('update', $inventory); // Check permission

        return view('admin.inventory._editQtt', compact('inventory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInventoryRequest $request, $id)
    {
        // return $request->textile;
        $inventory = $this->inventory->update($request, $id);

        // For inspectable
        if (! Auth::user()->isFromPlatform()) {
            $this->authorize('update', $inventory); // Check permission
        }

        $request->session()->flash('success', trans('messages.updated', ['model' => $this->model]));
        Session::put('invoiceId',$id);

        return response()->json($this->getJsonParams($inventory));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateQtt(Request $request, $id)
    {
        $inventory = $this->inventory->updateQtt($request, $id);

        return response("success", 200);
    }

    /**
     * Trash the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request, $id)
    {
        $this->inventory->trash($id);

        return back()->with('success', trans('messages.trashed', ['model' => $this->model]));
    }

    /**
     * Restore the specified resource from soft delete.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, $id)
    {
        $this->inventory->restore($id);

        return back()->with('success', trans('messages.restored', ['model' => $this->model]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->inventory->destroy($id);

        return back()->with('success',  trans('messages.deleted', ['model' => $this->model]));
    }

    /**
     * Trash the mass resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function massTrash(Request $request)
    {
        $this->inventory->massTrash($request->ids);

        if ($request->ajax()) {
            return response()->json(['success' => trans('messages.trashed', ['model' => $this->model])]);
        }

        return back()->with('success', trans('messages.trashed', ['model' => $this->model]));
    }

    /**
     * Trash the mass resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function massDestroy(Request $request)
    {
        $this->inventory->massDestroy($request->ids);

        if ($request->ajax()) {
            return response()->json(['success' => trans('messages.deleted', ['model' => $this->model])]);
        }

        return back()->with('success', trans('messages.deleted', ['model' => $this->model]));
    }

    /**
     * Empty the Trash the mass resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function emptyTrash(Request $request)
    {
        $this->inventory->emptyTrash($request);

        if ($request->ajax()) {
            return response()->json(['success' => trans('messages.deleted', ['model' => $this->model])]);
        }

        return back()->with('success', trans('messages.deleted', ['model' => $this->model]));
    }

    /**
     * return json params to procceed the form
     *
     * @param  Product $product
     *
     * @return array
     */
    private function getJsonParams($inventory)
    {
        $route = Auth::user()->isFromPlatform() ? 'admin.inspector.inspectables' : 'admin.stock.inventory.index';

        return [
            'id' => $inventory->id,
            'model' => 'inventory',
            'redirect' => 'false'//route($route)
        ];
    }

    // function will process the ajax request
    public function getInventory(Request $request, $status) {

        $inventory = $this->inventory->all($status);

        return Datatables::of($inventory)
            ->editColumn('checkbox', function($inventory){
                return view('admin.inventory.partials.checkbox', compact('inventory'));
            })
            ->addColumn('option', function ($inventory) {
                return view('admin.inventory.partials.options', compact('inventory'));
            })
            ->editColumn('image', function($inventory){
                return view('admin.inventory.partials.image', compact('inventory'));
            })
            ->editColumn('sku', function($inventory){
                return view('admin.inventory.partials.sku', compact('inventory'));
            })
            ->editColumn('title', function($inventory){
                return view('admin.inventory.partials.title', compact('inventory'));
            })
            ->editColumn('condition',  function ($inventory) {
                return view('admin.inventory.partials.condition', compact('inventory'));
            })
            ->editColumn('price', function($inventory){
                return view('admin.inventory.partials.price', compact('inventory'));
            })
            ->editColumn('quantity', function($inventory){
                return view('admin.inventory.partials.quantity', compact('inventory'));
            })
            ->rawColumns(['image', 'sku', 'title', 'condition', 'price', 'quantity', 'checkbox', 'option'])
            ->make(true);
    }

    public function getAttributeValue(Request $request){
    
        $attributeCategory = $this->inventory->findProduct($request->product_id);
        $attribute = [];
        $attributeValue = [];     
        foreach($request->attributeId as $attributeId){
            $array = explode(",",$attributeId);
            $attrID = $array[0];
            $attrValueID = isset($array[1]) ? $array[1] : '';
            $attributeValue[] = $this->inventory->getAttributeValues($attrID,$attrValueID);
            $attribute[] = $this->inventory->getAttributeAndSublist($attrID,$attrValueID);
        }
        return view('admin.inventory._showCustomiseOptions',compact('attributeValue','attributeCategory','attribute'));
    }

    public function saveCustomiseInventryDetail(Request $request){
        $requestData = $request->all();
        $this->inventory->InventoryInCustomise(session('invoiceId'));
        $check = false;
       foreach($requestData as $attrAndSublist => $cateId){
            foreach($cateId as $CateID){
                $ids = explode(',', $attrAndSublist);
                $attrID = $ids[0];
                $attrSublistID = isset($ids[1]) ? $ids[1]:'';
                $categoryId = $CateID;
            
                $values = 'vall_'.$attrID.''.$attrSublistID.''.$CateID;
             
                if(isset($requestData[$values])){
                    foreach($requestData[$values] as $values){
                        $customise['attrValue_id'] = $values;
                        $customise['inventories_id'] = session('invoiceId');
                        $customise['category_id'] = $categoryId;
                        $customise['attribute_id'] = $attrID;
                        $customise['attributeSublist_id'] = $attrSublistID === '' ? null : $attrSublistID;
                        $check = $this->inventory->saveCutomiseInentryData($customise);
                    }
                }
            }
       }
       if($check){
        return 'Data Save Successfully...';
       }
       else{
        return 'There is no values added on category please add the values....';
        }
    }

    public function getValuesOfCategory(Request $request){
        $id = $request->catId;
        $ids = $request->ids;
        $attrID = $request->attrID;
        $attrSublistID = $request->attrSublistID;
        $selectedalueIds = [0];
        $category = $this->inventory->getCategory($id);
       
        $attributeValue =$this->inventory->getValuesOfCategory($id);
        $selectedValue =$this->inventory->getSelectedValue($attrID,$attrSublistID);
        if(count($selectedValue) > 0){
            foreach($selectedValue as $values){
                $selectedalueIds[]  = $values->attrValue_id;      
            }
        }
        // dd($attributeValue);
        // dd(count($attributeValue));
       if(count($attributeValue)===0 ){
           return '<div style="margin-top:30px;">There is no values added on "'.$category->name.'" category please add the values....</div>';
       }
        return view('admin.inventory._attributeValueList',compact('attributeValue','ids','selectedalueIds'));
    }

}
