<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use View,
    Redirect;
use Illuminate\Http\Request;
/**
 * Models
 */
use App\Http\Models\Tasks;
use App\Http\Models\Statuses;
use App\Http\Models\Categories;
use App\Http\Models\Posts;

class PostsController extends Controller {

    public $data = array();

    /**
     *
     */
    public function getList(Request $request) {

        $obj_posts = new Posts();
        $obj_statuses = new Statuses;

        $search = $request->all();

        $posts = $obj_posts->getList($search);

        $statuses = $obj_statuses->pushSelectBox();


        $data = array_merge($this->data, array(
            'posts' => $posts,
            'statuses' => array_merge(array(0 => 'None'), $statuses->toArray()),
            'request' => $request,
        ));

        return View::make('laravel-authentication-acl::admin.posts.list-posts')->with(['data' => $data]);
    }

    /**
     *
     */
    public function editPost(Request $request) {
        $obj_posts = new Posts();

        $obj_statuses = new Statuses;

        $post_id = $request->get('id');
        $post = $obj_posts->findPostId($post_id);
        $statuses = $obj_statuses->pushSelectBox();
        if ($post) {
            $data = array_merge($this->data, array(
                'post' => $post,
                'statuses' => array_merge(array(0 => 'None'), $statuses->toArray()),
                'request' => $request,
            ));
            return View::make('laravel-authentication-acl::admin.posts.form-post')->with(['data' => $data]);
        } else if (is_null($post_id)) {

            $data = array_merge($this->data, array(
                'statuses' => array_merge(array(0 => 'None'), $statuses->toArray()),
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
    public function postEditPost(Request $request) {

        $obj_posts = new Posts();

        $input = $request->all();

        $post_id = $request->get('id');

        $post = $obj_posts->findPostId($post_id);

        if ($post) {
            //edit
            $obj_posts->updatePost($input);
            return Redirect::route("posts.list")->withMessage(trans('posts.post_edit_successful'));
        } elseif (empty($post_id)) {
            //add
            $obj_posts->addPost($input);
            return Redirect::route("posts.list")->withMessage(trans('posts.post_edit_successful'));
        } else {
            //error
        }
    }

    /**
     *
     */
    public function deletePost(Request $request) {
        $obj_posts = new Posts();

        $post_id = $request->get('id');
        $post = $obj_posts->findPostId($post_id);

        if ($post) {

            $obj_posts->deletePostById($post_id);
            return Redirect::route("posts.list")->withMessage(trans('posts.post_delete_successful'));
        } else {
            return Redirect::route("posts.list")->withMessage(trans('posts.post_delete_unsuccessful'));
        }
    }

}
