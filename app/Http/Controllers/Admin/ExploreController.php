<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Explore\ExploreRepostory;
use App\Http\Requests\Validations\CreatePostRequest;
use App\Http\Requests\Validations\MerchantProfile;
use App\Category;
use App\Inventory;
use App\Post;
use App\Product;
use Auth;

class ExploreController extends Controller
{
    private $explore;

    public function __construct(ExploreRepostory $explore){
        parent::__construct();

        $this->explore = $explore;
    }
    
    public function index()
    {
        $shop_id = Auth::user()->shop_id;
        $postcount = $this->explore->getCount('App\Post');
        $productcount = $this->explore->getCount('App\Inventory');
        $reviewscount = $this->explore->getCount('App\CustomerReviews');
        $followerscount = $this->explore->getCount('App\Followers');
        
        $profileInfo = $this->explore->merchantProfileInfo();
        return view('admin.explore.index',compact('profileInfo','followerscount','reviewscount','productcount','postcount'));
    }

   
    public function create()
    {
        $category = Category::all();
        return view('admin.explore._create_post',compact('category'));
    }

  
    public function store(CreatePostRequest $request)
    {      
        $inventory = Inventory::where('product_id',$request->product_id)->first();

        $this->explore->saveData($request,$inventory);
        $post = $this->explore->getPosts();
        return view('admin.explore._trForTables',compact('post'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = Category::all();
        $post = $this->explore->editPost($id);
        return view('admin.explore._edit',compact('post','category'));
    }

    public function update(CreatePostRequest $request, $id)
    {
        $inventory = Inventory::where('product_id',$request->product_id)->first();
        $this->explore->updatePost($request,$id,$inventory);       
        $post = $this->explore->getPosts();
        return view('admin.explore._trForTables',compact('post')); 
    }

  
    public function destroy($id)
    {

    }

    public function posts(Request $request){
        if($request->type === 'post'){
           $post = $this->explore->getPosts();
            return view('admin.explore.post',compact('post'));        
        }
        elseif($request->type === 'product'){
           $product = $this->explore->getProduct();
           $profile = $this->explore->merchantProfileInfo();
            return view('admin.explore._show_product',compact('product','profile'));            
        }
        elseif($request->type === 'reviews'){
           $review = $this->explore->getReviews();
            return view('admin.explore._show_reviews',compact('review'));            
        }
        elseif($request->type === 'followers'){
           $follower = $this->explore->getFollowers();
            return view('admin.explore._followers',compact('follower'));            
        }
        elseif($request->type === 'about'){
           $about = $this->explore->getAbout();
            return view('admin.explore.about',compact('about'));            
        }
    } 

    public function filter(Request $request){
        $type = $request->type;
        $product = $this->explore->filter($type);
        return view('admin.explore._product',compact('product'));
    }

    public function getProductByCategory($id){
        $project = $this->explore->getProductByCategory($id); 
        foreach($project as $Project){ ?>
            <option value="<?php echo $Project->id; ?>"><?php echo $Project->name; ?></option>
        <?php }

    }

    public function editProfile(){
        $profile = $this->explore->getMerchantInfo();
        return view('admin.explore.editProfile',compact('profile'));
    }

    public function saveMerchantProfile(MerchantProfile $request){     
        // dd($request);         
        $merchant = $this->explore->saveMerchant($request);       
        return  $merchant; 
    }

    public function deletepost(Request $request ,$id){
        $this->explore->deletePost($id);
        $post = $this->explore->getPosts();
        return view('admin.explore._trForTables',compact('post'));
    }
}
