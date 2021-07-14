<?php 

namespace App\Repositories\Explore;

use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;
use App\Post;
use App\Product;
use App\Inventory;
use App\Followers;
use App\CustomerReviews;
use App\MerchantProfile;
use App\Image;
use Auth;

class ExploreRepostory extends EloquentRepository {

	protected $model;
	protected $model_name = 'App\Post';
	
	 public function saveData(Request $request,$inventory)
    {
    	$data['title'] = $request->title;
    	$data['description'] = $request->description;
    	$data['shop_id'] = $request->shop_id;
        $data['slug'] = $inventory->slug;
        $data['product_id'] = $inventory->product_id;
        $data['category_id'] = $request->category_id;
        
        $post = Post::create($data);

       if ($request->hasFile('image')) {
            $post->saveImage($request->file('image'));
       }

        return $post;
    }

    public function getPosts(){
    	$shopId = Auth::user()->shop_id;
    	return Post::with(['image','comments','share','like'])->where('shop_id',$shopId)->get();
    }

    public function getProduct(){
        $shopId = Auth::user()->shop_id;
        return Inventory::with(['image','product'])->where('shop_id',$shopId)->get();
    }

    public function getReviews(){
        $shopId = Auth::user()->shop_id;
        return CustomerReviews::with('customer.image')->whereNull('deleted_at')->where('shop_id',$shopId)->get();
    }

    public function getFollowers(){
        $shopId = Auth::user()->shop_id;
        return Followers::with('getFollowers.image')->where('shop_id',$shopId)->get();
    }

    public function getAbout(){
        $userId = Auth::user()->id;
        return MerchantProfile::where('user_id',$userId)->first();
    }

    public function editPost($id){
        return Post::with(['product','category'])->find($id);
    }

    public function updatePost(Request $request,$id,$inventory){

        $data['title'] = $request->title;
        $data['description'] = $request->description;
        $data['shop_id'] = $request->shop_id;
        $data['slug'] = $inventory->slug;
        $data['product_id'] = $inventory->product_id;   
        $data['category_id'] = $request->category_id;
        
        Post::find($id)->update($data);   
        $post = Post::find($id);

        if ($request->hasFile('image') || ($request->input('delete_image') == 1)) {
            $post->deleteImage();
        }

        if ($request->hasFile('image')) {
            $post->saveImage($request->file('image'));
        }
    }

    public function filter($type){

        if($type === 'new'){
            return Inventory::with(['image','product'])->where('shop_id',Auth::user()->shop_id)->orderBy('id','desc')->get();
        }
        elseif($type === 'old'){
            return Inventory::with(['image','product'])->where('shop_id',Auth::user()->shop_id)->orderBy('id','asc')->get();
        }
        elseif($type === 'byname'){
            return Inventory::with(['image','product'=>function($query){
                $query->orderBy('name', 'DESC');
            }])->where('shop_id',Auth::user()->shop_id)->get();
        }
        elseif($type === 'outOfStock'){
            return Inventory::with(['image','product'])->where('stock_quantity',0)->where('shop_id',Auth::user()->shop_id)->get();
        }
    }

    public function getProductByCategory($id){
        return Product::whereHas('categories',function($query)use($id){
            $query->where('id',$id);
        })->get();
    }

    public function getMerchantInfo (){        
        return MerchantProfile::with('images')->where('user_id',Auth::user()->id)->first();
    }

    public function saveMerchant(Request $request){     
        $data['name'] = $request->name;
        $data['exprience'] = $request->exprience;
        $data['description'] = $request->description;
        $data['location'] = $request->location;
        $data['lastdelivery'] = $request->lastdelivery;
        // $data['user_id'] = $request->user_id;
        MerchantProfile::where('user_id',Auth::user()->id)->update($data);
        $merchant = MerchantProfile::where('user_id',Auth::user()->id)->first();
        // $image = Image::find()
        if (isset($request->profile_image) || $request->hasFile('profile')) {
            $imageDel = Image::where(['imageable_id'=>$merchant->id,'type'=>'feature'])->first();      
            if($imageDel !== null){
                $merchant->deleteImage($imageDel);
            }
            
        }

        if(isset($request->cover_image ) || $request->hasFile('cover') ){
            $imageDel = Image::where(['imageable_id'=>$merchant->id,'type'=>'cover'])->first();                
            if($imageDel !== null){
                $merchant->deleteImage($imageDel);
            }
          
        }

        if($request->hasFile('profile') || $request->hasFile('cover') ){
            if ($request->hasFile('profile')) {
                $merchant->saveImage($request->file('profile'),'feature');
            }
            if ($request->hasFile('cover')) {
                $merchant->saveImage($request->file('cover'),'cover');
            }
        }

        return $merchant;

    }

    public function deletePost($id){
        return Post::find($id)->delete();
    }

    public function merchantProfileInfo(){
        return MerchantProfile::with(['images',])->where('user_id',Auth::user()->id)->first();
    }

    public function getCount($model){
        $shop_id = Auth::user()->shop_id;
        return $model::whereNull('deleted_at')->where('shop_id',$shop_id)->count();
    }
}
	
?>