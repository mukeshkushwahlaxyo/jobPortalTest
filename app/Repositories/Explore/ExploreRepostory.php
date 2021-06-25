<?php 

namespace App\Repositories\Explore;

use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;
use App\Post;
use App\Inventory;
use Auth;

class ExploreRepostory extends EloquentRepository {

	protected $model;
	protected $model_name = 'App\Post';
	
	 public function saveData(Request $request)
    {
    	$data['title'] = $request->title;
    	$data['description'] = $request->description;
    	$data['shop_id'] = $request->shop_id;
    	// dd($data);
        $post = Post::create($data);

       if ($request->hasFile('image')) {
            $post->saveImage($request->file('image'));
       }

        return $post;
    }

    public function getPosts(){
    	$shopId = Auth::user()->shop_id;
    	return Post::with('image')->where('shop_id',$shopId)->get();
    }

    public function getProduct(){
        $shopId = Auth::user()->shop_id;
        return Inventory::with(['image','product'])->where('shop_id',$shopId)->get();
    }

    public function editPost($id){
        return Post::find($id);
    }

    public function updatePost(Request $request,$id){
        $data['title'] = $request->title;
        $data['description'] = $request->description;
        $data['shop_id'] = $request->shop_id;
        Post::find($id)->update($data);   
        $post = Post::find($id);

        if ($request->hasFile('image') || ($request->input('delete_image') == 1)) {
            $post->deleteImage();
        }

        if ($request->hasFile('image')) {
            $post->saveImage($request->file('image'));
        }
    }
}
	
?>