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
use App\Http\Models\Levels;


class LevelsController extends Controller {

    public $data = array();

    /**
     *
     */
    public function getList(Request $request) {
        $obj_levels = new Levels();

        $levels = $obj_levels->getList();
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
        $level_id = $request->get('id');

        $level = $obj_levels->findStatusId($level_id);
        if ($level) {
            $data = array_merge($this->data, array(
                'level' => $level,
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
    public function postEditLevel() {
        echo 'postEditTask';
    }
 
    /**
     *
     */
    public function deleteLevel() {
        echo 'deleteTask';
    }

}
