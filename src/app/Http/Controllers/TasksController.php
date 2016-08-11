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
/**
 * Libraries
 */
use App\Http\Libraries\LibFiles as LibFiles;

class TasksController extends Controller {

    public $data = array();

    /**
     *
     */
    public function getList(Request $request) {

        $obj_tasks = new Tasks();
        $obj_statuses = new Statuses;

        $search = $request->all();

        $tasks = $obj_tasks->getList($search);

        $statuses = $obj_statuses->pushSelectBox();


        $data = array_merge($this->data, array(
            'tasks' => $tasks,
            'statuses' => array_merge(array(0 => trans('tasks.task_select_all')), $statuses->toArray()),
            'request' => $request,
        ));

        return View::make('laravel-authentication-acl::admin.tasks.list-tasks')->with(['data' => $data]);
    }

    /**
     *
     */
    public function editTask(Request $request) {
        $obj_tasks = new Tasks();

        $obj_statuses = new Statuses;

        $task_id = $request->get('id');

        $task = $obj_tasks->findTaskId($task_id);

        if ($task) {
            $data = array_merge($this->data, array(
                'task' => $task,
                'statuses' => $obj_statuses->pushSelectBox(),
                'request' => $request,
            ));
            return View::make('laravel-authentication-acl::admin.tasks.form-task')->with(['data' => $data]);
        } else if (is_null($task_id)) {
            $data = array_merge($this->data, array(
                'task' => $task,
                'statuses' => $obj_statuses->pushSelectBox(),
                'request' => $request,
            ));
            return View::make('laravel-authentication-acl::admin.tasks.form-task')->with(['data' => $data]);
        } else {
            return Redirect::route("tasks.list")->withMessage(trans('re.not_found'));
        }
    }

    /**
     *
     */
    public function postEditTask(Request $request) {
        $libFiles = new LibFiles();

        $obj_tasks = new Tasks();

        $input = $request->all();

        $task_id = $request->get('id');

        $task = $obj_tasks->findTaskId($task_id);

        $configs = config('dragonknight.libfiles');
        $file = $request->file('image');
        $fileinfo = $libFiles->upload($configs['task'], $file);

        if ($task) {
            //edit
            $obj_tasks->updateTask($input);
            return Redirect::route("tasks.list")->withMessage(trans('tasks.task_edit_successful'));
        } elseif (empty($task_id)) {
            //add
            $obj_tasks->addTask($input);
            return Redirect::route("tasks.list")->withMessage(trans('tasks.task_edit_successful'));
        } else {
            //error
        }
    }

    /**
     *
     */
    public function deleteTask(Request $request) {
        $obj_tasks = new Tasks();

        $task_id = $request->get('id');
        $task = $obj_tasks->findTaskId($task_id);

        if ($task) {

            $obj_tasks->deleteTaskById($task_id);
            return Redirect::route("tasks.list")->withMessage(trans('tasks.task_delete_successful'));
        } else {
            return Redirect::route("tasks.list")->withMessage(trans('tasks.task_delete_unsuccessful'));
        }
    }

}
