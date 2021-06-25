<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Explore\ExploreRepostory;
use App\Http\Requests\Validations\CreatePostRequest;

class ExploreController extends Controller
{
    private $explore;

    public function __construct(ExploreRepostory $explore){
        parent::__construct();

        $this->explore = $explore;
    }
    
    public function index()
    {
        $post = $this->explore->getPosts();
        return view('admin.explore.index');
    }

   
    public function create()
    {
        return view('admin.explore._create_post');
    }

  
    public function store(CreatePostRequest $request)
    {      
        $this->explore->saveData($request);
        $post = $this->explore->getPosts();
        return view('admin.explore._trForTables',compact('post'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $post = $this->explore->editPost($id);
        return view('admin.explore._edit',compact('post'));
    }

    public function update(CreatePostRequest $request, $id)
    {
        $post = $this->explore->updatePost($request,$id);        
    }

  
    public function destroy($id)
    {
        //
    }

    public function posts(Request $request){
        if($request->type === 'post'){
           $post = $this->explore->getPosts();
            return view('admin.explore.post',compact('post'));        
        }
        elseif($request->type === 'product'){
           $product = $this->explore->getProduct();
            return view('admin.explore._show_product',compact('product'));            
        }
    } 
}
