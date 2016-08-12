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

        $categories_parent = $obj_categories->pushSelectBox(); 
        
        if ($category) {
            $data = array_merge($this->data, array(
                'category' => $category,
                'categories' => array_merge(array(0 => trans('categories.category_select_none')), $categories_parent->toArray()),
                'request' => $request,
            ));
            return View::make('laravel-authentication-acl::admin.categories.form-category')->with(['data' => $data]);
        } else if (is_null($category_id)) {
            $data = array_merge($this->data, array(
                'category' => $category,
                'categories' =>array_merge(array(0 => trans('categories.category_select_none')), $categories_parent->toArray()),
                'request' => $request,
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

            $input = $request->all();

        $category_id = $request->get('id');

        $category = $obj_categories->findCategoryId($category_id);
        $configs = config('dragonknight.libfiles');
        $file = $request->file('image'); 
        $fileinfo = $libFiles->upload($configs['category'], $file);

        if ($category) {
            //edit
            $params = array_merge($input, $fileinfo); 
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
