<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use View, Redirect;
use Illuminate\Http\Request;
/**
 * Models
 */
use App\Http\Models\Tasks;
use App\Http\Models\Statuses;
use App\Http\Models\Categories;


class CategoriesController extends Controller {

    public $data = array();

    /**
     *
     */
    public function getList(Request $request) {
        $obj_categories = new Categories();

        $categories = $obj_categories->getList();
        $data = array_merge($this->data, array(
            'categories' => $categories,
            'request' => $request,
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
         
        if ($category) {
            $data = array_merge($this->data, array(
                'category' => $category,
                'request' => $request,
            ));
            return View::make('laravel-authentication-acl::admin.categories.form-category')->with(['data' => $data]);
       } else if (is_null($category_id)) {

            $data = array_merge($this->data, array(
                'category' => null, 
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
        $obj_category = new Categories();
      
        $input = $request->all();
        
        $category_id = $request->get('id');
        
 
        $category = $obj_category->findCategoryId($category_id);

        if ($category) {
            //edit
            $obj_category->updateCategory($input);
            return Redirect::route("categories.list")->withMessage(trans('categories.categories_edit_successful'));

        } elseif (empty($category_id)) {
            //add
            $obj_category->addCategory($input);
            return Redirect::route("categories.list")->withMessage(trans('categories.categories_edit_successful'));
            
        } else {
            //error
        }
    }

    /**
     *
     */
    public function deleteCategory() {
        echo 'deleteTask';
    }

}
