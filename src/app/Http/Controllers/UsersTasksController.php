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
use App\Http\Models\UsersTasks;
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
use App\Http\Requests\UserTaskValidator;
    
class UsersTasksController extends Controller {

    public $data = array();

    /**
     *
     */
    public function getList(Request $request) {
        $obj_users_tasks = new UsersTasks();
        $obj_statuses = new Statuses;

        $search = $request->all();

        $users_tasks = $obj_users_tasks->getList($search);

        $statuses = $obj_statuses->pushSelectBox();
        
        $configs = config('dragonknight.libfiles');

        $data = array_merge($this->data, array(
            'users_tasks' => $users_tasks,
            'statuses' => array_merge(array(0 => trans('tasks.task_select_all')), $statuses->toArray()),
            'request' => $request,
            'configs' => $configs
        ));

        return View::make('laravel-authentication-acl::admin.users_tasks.list-users-tasks')->with(['data' => $data]);
    }
 

}
