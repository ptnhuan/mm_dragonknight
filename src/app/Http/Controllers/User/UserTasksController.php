<?php

namespace App\Http\Controllers\User;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use App\Http\Controllers\Controller;
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

class UserTasksController extends Controller {

    public $data = array();

    public function __construct() {
        $authentication = \App::make('authenticator');
        $current_user = $authentication->getLoggedUser()->toArray();
        $this->data = array(
            'current_user' => $current_user,
        );
    }

    /**
     *
     */
    public function getList(Request $request) {
        $obj_user_tasks = new UsersTasks();
        $obj_statuses = new Statuses;

        $params = $request->all();
        $params = array_merge($params, $this->data);

        $user_tasks = $obj_user_tasks->userGetTasks($params);

        $statuses = $obj_statuses->pushSelectBox();

        $configs = config('dragonknight.libfiles');

        $data = array_merge($this->data, array(
            'user_tasks' => $user_tasks,
            'statuses' => $statuses->toArray(),
            'request' => $request,
            'configs' => $configs
        ));

        return View::make('laravel-authentication-acl::user.user_tasks.list-user-tasks')->with(['data' => $data]);
    }

    public function editUserTask(Request $request) {
        $obj_user_tasks = new UsersTasks();

        $obj_statuses = new Statuses;

        $user_task_id = $request->get('id');

        $user_task = $obj_user_tasks->getUserTaskInfo($user_task_id);

        $configs = config('dragonknight.libfiles');
        $statuses = $obj_statuses->pushSelectBox();
        $data = array_merge($this->data, array(
            'user_task' => $user_task,
            'statuses' => $statuses->toArray(),
            'request' => $request,
            'configs' => $configs
        ));

        return View::make('laravel-authentication-acl::user.user_tasks.form-user-task')->with(['data' => $data]);
    }

    public function postEditUserTask(Request $request) {
        $obj_user_task = new UsersTasks();

        $input = $request->all();

        $user_task_id = $request->get('id');

        $user_task = $obj_user_task->find($user_task_id);
        if ($user_task) {
            //edit
            $obj_user_task->updateStatus($input);
            return Redirect::route("user_tasks.list")->withMessage(trans('statuses.status_edit_successful'));
        } else {
            //error
        }
    }

}
