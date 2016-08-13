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
use App\Http\Models\Categories;
use App\Http\Models\Statuses;
/**
 * Libraries
 */
use App\Http\Libraries\LibFiles as LibFiles;
/**
 * Validator
 */
use Validator;
use Response;
use Illuminate\Support\MessageBag as MessageBag;
use App\Http\Requests\CategoryValidator;

class CategoriesController extends Controller {

    public $data = array();

    /**
     *
     */
    public function getList(Request $request) {

        $obj_categories = new Categories();
        $obj_statuses = new Statuses;

        $search = $request->all();

        $categories = $obj_categories->getList($search);

        $statuses = $obj_statuses->pushSelectBox();
        $configs = config('dragonknight.libfiles');

        $data = array_merge($this->data, array(
            'categories' => $categories,
            'request' => $request,
            'configs' => $configs
        ));

        return View::make('laravel-authentication-acl::admin.categories.list-categories')->with(['data' => $data]);
    }

    /**
     *
     */
    public function editCategory(Request $request) {
        $obj_categories = new Categories();
        $category_id = $request->get('id');
        $category = $obj_categories->findCategoryId($category_id);

        $errors = $request->session()->get('errors', null);
        $message = $request->session()->get('message', FALSE);
        $input = $request->session()->get('input', null);

        $request->session()->forget('errors');
        $request->session()->forget('message');
        $request->session()->forget('input');
        $configs = config('dragonknight.libfiles');

        $categories_parent = $obj_categories->pushSelectBox();

        if ($category) {
            $data = array_merge($this->data, array(
                'category' => $category,
                'categories' => array_merge(array(0 => trans('categories.category_select_none')), $categories_parent->toArray()),
                'request' => $request,
                'errors' => $errors,
                'input' => $input,
                'message' => $message,
                'configs' => $configs,
            ));
            return View::make('laravel-authentication-acl::admin.categories.form-category')->with(['data' => $data]);
        } else if (is_null($category_id)) {
            $data = array_merge($this->data, array(
                'category' => $category,
                'categories' => array_merge(array(0 => trans('categories.category_select_none')), $categories_parent->toArray()),
                'request' => $request,
                'errors' => $errors,
                'input' => $input,
                'message' => $message,
                'configs' => $configs,
            ));
            return View::make('laravel-authentication-acl::admin.categories.form-category')->with(['data' => $data]);
        } else {
            return Redirect::route("categories.list")->withMessage(trans('re.not_found'));
        }
    }

    /**
     *
     */
    public function postEditCategory(Request $request) {
        $libFiles = new LibFiles();

        $obj_categories = new Categories();
        $validator = new CategoryValidator();

        $input = $request->all();

        $category_id = $request->get('id');

        $category = $obj_categories->findCategoryId($category_id);


        if (!empty($validator->validate($input))) {
            $fileinfo = array();
            if (!empty($input['image'])) {
                $configs = config('dragonknight.libfiles');
                $file = $request->file('image');
                $fileinfo = $libFiles->upload($configs['category'], $file);
            } else {
                $fileinfo['filename'] = '';
            }

            //TODO: check
            $input = array_merge($input, $fileinfo);
            /**
             * VALID
             */
            if ($category) {
                //edit
                if (empty($fileinfo['filename']) && $input['is_file'])
                {
                    $input['filename'] = $category->category_image;
                }

                $params = array_merge($fileinfo, $input);
                $obj_categories->updateCategory($params);

                return Redirect::route("categories.list")->withMessage(trans('categories.category_edit_successful'));
            } elseif (empty($category_id)) {
                //add

                 $params = array_merge($input, $fileinfo);
                $obj_categories->addCategory($params);
               return Redirect::route("categories.list")->withMessage(trans('categories.category_edit_successful'));
            } else {
                //error
            }
        } else {
            $errors = $validator->getErrors();
            if (!empty($category_id)) {
                $request->session()->put('errors', $errors);
                $request->session()->put('message', true);
                $request->session()->put('input', $request->all());
                return Redirect::route("categories.edit", ["id" => $category_id]);
            } else {
                $request->session()->put('errors', $errors);
                $request->session()->put('message', true);
                $request->session()->put('input', $request->all());
                return Redirect::route("categories.edit");
            }
        }
    }

    /**
     *
     */
    public function deleteCategory(Request $request) {
        $obj_categories = new Categories();

        $category_id = $request->get('id');
        $category = $obj_categories->findCategoryId($category_id);

        if ($category) {

            $obj_categories->deleteCategoryById($category_id);
            return Redirect::route("categories.list")->withMessage(trans('categories.category_delete_successful'));
        } else {
            return Redirect::route("categories.list")->withMessage(trans('categories.category_delete_unsuccessful'));
        }
    }

}
