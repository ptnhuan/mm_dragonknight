<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

use View,Redirect;
use Illuminate\Http\Request;
/**
 * Models
 */
use App\Http\Models\Tasks;
use App\Http\Models\Statuses;
use App\Http\Models\Categories;
use App\Http\Models\Faqs;
use App\Http\Models\Posts;

class PostsController extends Controller
{

    public $data = array();
    /**
     *
     */
    public function getList(Request $request){


        $obj_posts = new Posts();
        $posts = $obj_posts->getList();

        $data = array_merge($this->data, array(
            'posts' => $posts,
            'request' => $request,
        ));

        return View::make('laravel-authentication-acl::admin.posts.list-posts')->with(['data' => $data]);
    }

     /**
     *
     */
    public function editPost(Request $request) {
        $obj_posts = new Posts();

        $post_id = $request->get('id');

        $post = $obj_posts->findPostId($post_id);
        if ($post) {
            $data = array_merge($this->data, array(
                'post' => $post,
                'request' => $request,
            ));
            return View::make('laravel-authentication-acl::admin.posts.form-post')->with(['data' => $data]);
        } else {
            return Redirect::route("posts.list")->withMessage(trans('re.not_found'));
        }
    }


     /**
     *
     */
    public function postEditPost(){
                echo 'postEditPost';


    }

     /**
     *
     */
    public function deletePost(){
                echo 'deletePost';


    }

}
