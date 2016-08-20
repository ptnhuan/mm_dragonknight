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
use App\Http\Models\Statuses;
use App\Http\Models\Categories;
use App\Http\Models\Posts;
use App\Http\Models\Levels;
use App\Http\Models\Users;
/**
 * Libraries
 */
use App\Http\Libraries\LibFiles;
/**
 * Validator
 */
use Validator;
use App\Http\Requests\PostValidator;
use Response;
use Illuminate\Support\MessageBag as MessageBag;

class PostsController extends Controller {

    public $data = array();

    /**
     *
     */
    public function getList(Request $request) {

        $obj_posts = new Posts();

        $obj_statuses = new Statuses;
        $obj_categories = new Categories;
        $obj_levels = new Levels;

        $search = $request->all();

        $posts = $obj_posts->getList($search);

        $statuses = $obj_statuses->pushSelectBox();
        $categories = $obj_categories->pushSelectBox();
        $levels = $obj_levels->pushSelectBox();


        $data = array_merge($this->data, array(
            'posts' => $posts,
            'statuses' => array_merge(array(0 => 'None'), $statuses->toArray()),
            'categories' => array_merge(array(0 => 'None'), $categories->toArray()),
            'levels' => array_merge(array(0 => 'None'), $levels->toArray()),
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
        $obj_categories = new Categories;
        $obj_levels = new Levels;

        $authentication = \App::make('authenticator');
        $current_user = $authentication->getLoggedUser()->toArray();
        $this->data = array(
            'current_user' => $current_user,
        );
        
        $post_id = $request->get('id');

        $post = $obj_posts->findPostId($post_id);

        $errors = $request->session()->get('errors', null);
        $message = $request->session()->get('message', FALSE);
        $input = $request->session()->get('input', null);

        $request->session()->forget('errors');
        $request->session()->forget('message');
        $request->session()->forget('input');
        $configs = config('dragonknight.libfiles');
        if ($post) {
            $data = array_merge($this->data, array(
                'post' => $post,
                'statuses' => $obj_statuses->pushSelectBox(),
                'categories' => $obj_categories->pushSelectBox(),
                'levels' => $obj_levels->pushSelectBox(),
                'request' => $request,
                'errors' => $errors,
                'input' => $input,
                'message' => $message,
                'configs' => $configs,
            ));
            return View::make('laravel-authentication-acl::admin.posts.form-post')->with(['data' => $data]);
        } else if (is_null($post_id)) {
            $data = array_merge($this->data, array(
                'post' => $post,
                'statuses' => $obj_statuses->pushSelectBox(),
                'categories' => $obj_categories->pushSelectBox(),
                'levels' => $obj_levels->pushSelectBox(),
                'request' => $request,
                'errors' => $errors,
                'input' => $input,
                'message' => $message,
                'configs' => $configs,
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
        $libFiles = new LibFiles();

        $validator = new PostValidator;

        $obj_posts = new Posts();

        $input = $request->all();

        $post_id = $request->get('id');

        $post = $obj_posts->findPostId($post_id);

        /**
         * Validator value
         */
        if (!empty($validator->validate($input))) {
            /**
             * Upload file images
             * check: extension, size
             */
            $fileinfo = array();
            if (!empty($input['image'])) {
                $configs = config('dragonknight.libfiles');
                $file = $request->file('image');
                $fileinfo = $libFiles->upload($configs['post'], $file);
            } else {
                $fileinfo['filename'] = '';
            }
            //TODO: Check
            $input = array_merge($input, $fileinfo);
            /**
             * VALID
             */
            if ($post) {
                if (empty($fileinfo['filename']) && $input['is_file']) {
                    $input['filename'] = $post->post_image;
                }
                //edit
                $params = array_merge($fileinfo, $input);

                $obj_posts->updatePost($params);
                return Redirect::route("posts.list")->withMessage(trans('posts.post_edit_successful'));
            } elseif (empty($post_id)) {
                //add
                $params = array_merge($input, $fileinfo);
                $post = $obj_posts->addPost($params);
                return Redirect::route("posts.edit", ["id" => $post->post_id])->withMessage(trans('posts.post_add_successful'));
            } else {
                //error
            }
        } else {
            /**
             * UNVALID
             */
            $errors = $validator->getErrors();
            if (!empty($post_id)) {
                $request->session()->put('errors', $errors);
                $request->session()->put('message', true);
                $request->session()->put('input', $request->all());

                return Redirect::route("posts.edit", ["id" => $post_id]);
            } else {
                $request->session()->put('errors', $errors);
                $request->session()->put('message', true);
                $request->session()->put('input', $request->all());

                return Redirect::route("posts.edit");
            }
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
