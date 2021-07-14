<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Like;
use App\Followers;
use App\Comment;
use App\CustomerReviews;

class ExploreController extends Controller
{
    public function getPost(){
        $post = Post::with(['image','comments'])->get();
        return $post;
    }

    public function like(Request $request){
        $data['shop_id'] = $request->shop_id;
        $data['customer_id'] = $request->customer_id;
        $data['post_id'] = $request->post_id;
        $like = Like::where(['shop_id'=>$data['shop_id'],'customer_id'=> $data['customer_id'] , 'post_id'=>$data['post_id']]);
        $isavailable = $like->first();
        
        if($isavailable === null){
            Like::create($data);
            return json_encode('Successfully Like');
        }
        else{
            $like->delete();
            return json_encode('Unlike successfully');
        }
    }

    public function follow(Request $request){
        $data['shop_id'] = $request->shop_id;
        $data['customer_id'] = $request->customer_id;
        $follow = Followers::where(['shop_id'=>$data['shop_id'],'customer_id'=> $data['customer_id']]);
        $isavailable = $follow->first();
        
        if($isavailable === null){
            Followers::create($data);
            return json_encode('Successfully Follow');
        }
        else{
            $follow->delete();
            return json_encode('Unfollow successfully');
        }
    }

    public function comment(Request $request){
        $data['user_id'] = $request->user_id;
        $data['post_id'] = $request->post_id;
        $data['body'] = $request->body;
        return json_encode(Comment::create($data));

    }

    public function deleteComment($id){
        return json_encode(Comment::destory($id));        
    }

    public function customerReview(Request $request){
        $data['shop_id'] = $request->shop_id;
        $data['customer_id'] = $request->customer_id;
        $data['description'] = $request->description;
        $data['rating'] = $request->rating;
        return json_encode(CustomerReviews::create($data));
    }
}
