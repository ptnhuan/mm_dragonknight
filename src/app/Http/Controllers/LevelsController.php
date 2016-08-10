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
use App\Http\Models\Levels;
use App\Http\Models\Statuses;

class LevelsController extends Controller {

    public $data = array();

    /**
     *
     */
    public function getList(Request $request) {

        $obj_levels = new Levels();
        $obj_statuses = new Statuses;

        $search = $request->all();

        $levels = $obj_levels->getList($search);
        $statuses = $obj_statuses->pushSelectBox();
        $data = array_merge($this->data, array(
            'levels' => $levels,
            'request' => $request,
        ));

        return View::make('laravel-authentication-acl::admin.levels.list-levels')->with(['data' => $data]);
    }

    /**
     *
     */
    public function editLevel(Request $request) {
        $obj_levels = new Levels();
        $obj_statuses = new Statuses;
        $level_id = $request->get('id');
        $level = $obj_levels->findLevelById($level_id);
        if ($level) {
            $data = array_merge($this->data, array(
                'level' => $level,
                'statuses' => $obj_statuses->pushSelectBox(),
                'request' => $request,
            ));
            return View::make('laravel-authentication-acl::admin.levels.form-level')->with(['data' => $data]);
        } else if (is_null($level_id)) {

            $data = array_merge($this->data, array(
                'level' => null,
                'statuses' => $obj_statuses->pushSelectBox(),
                'request' => $request,
            ));
            return View::make('laravel-authentication-acl::admin.levels.form-level')->with(['data' => $data]);
        } else {

            return Redirect::route("levels.list")->withMessage(trans('re.not_found'));
        }
    }

    /**
     *
     */
    public function postEditLevel(Request $request) {

        $obj_levels = new Levels();

        $input = $request->all();

        $level_id = $request->get('id');
 
        $level = $obj_levels->findLevelById($level_id);

        if ($level) {
            //edit
            $obj_levels->updateLevel($input);
            return Redirect::route("levels.list")->withMessage(trans('levels.level_edit_successful'));

        } elseif (empty($level_id)) {
            //add
            $obj_levels->addLevel($input);
            return Redirect::route("levels.list")->withMessage(trans('levels.level_edit_successful'));
            
        } else {
            //error
        }
    }

    /**
     *
     */
    public function deleteLevel(Request $request) {
        $obj_levels = new Levels();

        $level_id = $request->get('id');
        $level = $obj_levels->findLevelById($level_id);

        if ($level) {

            $obj_levels->deleteLevelById($level_id);
            return Redirect::route("levels.list")->withMessage(trans('levels.level_delete_successful'));
        } else {
            return Redirect::route("levels.list")->withMessage(trans('levels.level_delete_unsuccessful'));
        }
    }

}
