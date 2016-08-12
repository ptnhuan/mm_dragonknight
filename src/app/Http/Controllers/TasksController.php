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
/**
 * Validator
 */
use Validator;
use Response;
use Illuminate\Support\MessageBag as MessageBag;
use App\Http\Requests\TaskValidator;

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
        $configs = config('dragonknight.libfiles');

        $data = array_merge($this->data, array(
            'tasks' => $tasks,
            'statuses' => array_merge(array(0 => trans('tasks.task_select_all')), $statuses->toArray()),
            'request' => $request,
            'configs' => $configs
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
        $errors = $request->session()->get('errors', null);
        $message = $request->session()->get('message', FALSE);
        $input = $request->session()->get('input', null);

        $request->session()->forget('errors');
        $request->session()->forget('message');
        $request->session()->forget('input');
        $configs = config('dragonknight.libfiles');
        if ($task) {
            $data = array_merge($this->data, array(
                'task' => $task,
                'statuses' => $obj_statuses->pushSelectBox(),
                'request' => $request,
                'errors' => $errors,
                'input' => $input,
                'message' => $message,
                'configs' => $configs,
            ));
            return View::make('laravel-authentication-acl::admin.tasks.form-task')->with(['data' => $data]);
        } else if (is_null($task_id)) {
            $data = array_merge($this->data, array(
                'task' => $task,
                'statuses' => $obj_statuses->pushSelectBox(),
                'request' => $request,
                'errors' => $errors,
                'input' => $input,
                'message' => $message,
                'configs' => $configs,
            ));

            return View::make('laravel-authentication-acl::admin.tasks.form-task')->with(['data' => $data]);
        } else {
            return Redirect::route("tasks.list")->withMessage(trans('re.not_found'));
        }
    }

    /**
     * - Update existing task
     * - Add new task
     * @Check validator
     * @Upload multiple image
     */
    public function postEditTask(Request $request) {
        $libFiles = new LibFiles();
        $validator = new TaskValidator();

        $obj_tasks = new Tasks();

        $input = $request->all();

        $task_id = $request->get('id');

        $task = $obj_tasks->findTaskId($task_id);

        /**
         * Validator value
         */
        if (!empty($validator->validate($input))) {
            /**
             * Upload file image
             * @Check: extension, size
             */
            $fileinfo = array();
            if (!empty($input['image'])) {
                $configs = config('dragonknight.libfiles');
                $file = $request->file('image');
                $fileinfo = $libFiles->upload($configs['task'], $file);
            } else {
                $fileinfo['filename'] = '';
            }
            //TODO: check
            $input = array_merge($input, $fileinfo);
            /**
             * VALID
             */
            if ($task) {
                 if (empty($fileinfo['filename']) && $input['is_file']) {
                    $input['filename'] = $task->task_image;
                }
                //edit
                $params = array_merge($fileinfo, $input);

                $obj_tasks->updateTask($params);
                return Redirect::route("tasks.list")->withMessage(trans('tasks.task_edit_successful'));
            } elseif (empty($task_id)) {
                //add
                $params = array_merge($input, $fileinfo);
                $obj_tasks->addTask($params);
                return Redirect::route("tasks.list")->withMessage(trans('tasks.task_edit_successful'));
            } else {
                //error
            }
        } else {
            /**
             * UNVALID
             */
            $errors = $validator->getErrors();

            if (!empty($task_id)) {
                $request->session()->put('errors', $errors);
                $request->session()->put('message', true);
                $request->session()->put('input', $request->all());
                return Redirect::route("tasks.edit", ["id" => $task_id]);
            } else {
                $request->session()->put('errors', $errors);
                $request->session()->put('message', true);
                $request->session()->put('input', $request->all());
                return Redirect::route("tasks.edit");
            }
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
