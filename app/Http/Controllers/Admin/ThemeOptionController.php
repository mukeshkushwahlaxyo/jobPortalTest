<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\Validations\UpdateTrendingNowCategoryRequest;
use App\Manufacturer;
use App\OptionCategory;
use App\Option;
use App\Merchant;
use App\DesignerOption;
use Carbon\Carbon;
use App\Common\Authorizable;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\UpdateFeaturedBrandsRequest;
use App\Http\Requests\Validations\UpdateFeaturedCategories;

class ThemeOptionController extends Controller
{
    use Authorizable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('sdsds');
        // $storeFrontThemes = collect($this->storeFrontThemes());
        // $sellingThemes = collect($this->sellingThemes());
        // return view('admin.theme.index', compact('storeFrontThemes', 'sellingThemes'));
        // dd( get_from_option_table('featured_brands', []));
        // $featured_brands = Manufacturer::whereIn('id', get_from_option_table('featured_brands', []) ?? [])
        //     ->get()->pluck('name', 'id')->toArray();
        // $trending_categories = Category::whereIn('id', get_from_option_table('trending_categories', []) ?? [])
        //     ->get()->pluck('name', 'id')->toArray();


        $trending_categories = OptionCategory::with('getCategory')->where('option_id',2)->get();            
        $hand_made_cloth = OptionCategory::with('getCategory')->where('option_id',5)->get();            
        $suit_wear = OptionCategory::with('getCategory')->where('option_id',6)->get();            
        $top_designer = DesignerOption::with('getMerchant')->where('option_id',7)->get();            
        return view('admin.theme.options', compact('hand_made_cloth', 'trending_categories','suit_wear','top_designer'));

    }

    /**
     * Show the form for featuredCategories.
     * @return \Illuminate\Http\Response
     */
    public function featuredCategories()
    {
        $categories = Category::where('type',1)->get();
        $category = [];
        foreach ($categories as $key => $cat){
            array_push($category, [$cat->id => $cat->name.' | '. $cat->subGroup->name]);
        }
        $category = call_user_func_array('array_merge', $category);

        return view('admin.theme._edit_featured_categories', compact('category'));
    }

    public function EditDesignerHome($id)
    {
        $categories = Category::where('type',1)->get();
        $categoryOptions = OptionCategory::select('category_id')->where('option_id',$id)->get();       
        $catArray =  [];
        foreach($categoryOptions as $option){
            $catArray[] =  $option->category_id;
        }
        
        $route = 'admin.appearance.UpdateDesignerHome';
        return view('admin.theme.edit_designer_home', compact('categories','catArray','route','id'));
    }

    public function EditDesignerOption($id)
    {
        $categories = Merchant::all();
        $categoryOptions = DesignerOption::select('marchent_id')->where('option_id',$id)->get();       
        $catArray =  [];
        foreach($categoryOptions as $option){
            $catArray[] =  $option->marchent_id;
        }
        $route = 'admin.appearance.UpdateDesignerOption';
        return view('admin.theme.edit_designer_home', compact('categories','catArray','route','id'));
    }

    public function UpdateDesignerOption(Request $request,$id){
        DesignerOption::where('option_id',$id)->delete();
       foreach($request->designer_home as $key  => $catId){
            DesignerOption::create(['marchent_id'=>$catId,'option_id'=>$id]);
       }
       return redirect()->route('admin.appearance.theme.option', '#settings-tab')
        ->with('success', 'Update Successfully...');
    }

    public function UpdateDesignerHome(Request $request,$id)
    {
       OptionCategory::where('option_id',$id)->delete();
       foreach($request->designer_home as $key  => $catId){
            OptionCategory::create(['category_id'=>$catId,'option_id'=>$id]);
       }
       return redirect()->route('admin.appearance.theme.option', '#settings-tab')
        ->with('success', 'Update Successfully...');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateFeaturedCategories(UpdateFeaturedCategories $request)
    {
        Category::where('featured', true)->update(['featured' => Null]); // Reset all featured categories
        Category::whereIn('id', $request->input('featured_categories'))->update(['featured' => true]); //Set new

        return redirect()->route('admin.appearance.theme.option', '#settings-tab')
        ->with('success', trans('messages.updated_featured_categories'));
    }

    /**
     * Show the form for featuredCategories.
     * @return \Illuminate\Http\Response
     */
    public function featuredBrands()
    {
        $brands = Manufacturer::all()->pluck('name', 'id')->toArray();
        $featured_brands = Manufacturer::whereIn('id', get_from_option_table('featured_brands', []) ?? [])
            ->get()->pluck('name', 'id')->toArray();

        return view('admin.theme._edit_featured_brands', compact('featured_brands', 'brands'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateFeaturedBrands(UpdateFeaturedBrandsRequest $request)
    {
        $update = DB::table(get_option_table_name())->updateOrInsert(
            ['option_name' => 'featured_brands'],
            [
                'option_name' => 'featured_brands',
                'option_value' => serialize($request->featured_brands),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

        if ($update){
            return redirect()->route('admin.appearance.theme.option')
                ->with('success', trans('messages.featured_brands_updated'));
        }

        return redirect()->route('admin.appearance.theme.option')
            ->with('warning', trans('messages.failed'));
    }

    /**
     * Show form for Trending Categories.
     * @return \Illuminate\Http\Response
     */
    public function editTrendingNow()
    {
        $categories = Category::all()->pluck('name', 'id')->toArray();
        $trending_categories = Category::whereIn('id', get_from_option_table('trending_categories', []) ?? [])
            ->get()->pluck('name', 'id')->toArray();

        return view('admin.theme._edit_trending_categories', compact('categories', 'trending_categories'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateTrendingNow(UpdateTrendingNowCategoryRequest $request)
    {
         /*$limit = config('system.popular.trending_category');

         if ($limit < count($request->trending_categories)) {

            return redirect()->route('admin.appearance.theme.option')
                ->with('warning', trans('messages.trending_categories_update_failed', ['limit' => $limit]));
         }*/

        $update = DB::table(get_option_table_name())->updateOrInsert(
            ['option_name' => 'trending_categories'],
            [
                'option_name' => 'trending_categories',
                'option_value' => serialize($request->trending_categories),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

        if ($update) {
            return redirect()->route('admin.appearance.theme.option')
                ->with('success', trans('messages.trending_now_category_updated'));
        }

        return redirect()->route('admin.appearance.theme.option')
            ->with('warning', trans('messages.failed'));
    }

}
