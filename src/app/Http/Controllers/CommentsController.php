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
use App\Http\Models\Comments;
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

class CommentsController extends Controller {

    public $data = array();

    /**
     *
     */
    public function getList(Request $request) {

        $obj_comments = new Comments();
        $obj_statuses = new Statuses;

        $input = $request->all();

        $comments = $obj_comments->getList($input);

        $statuses = $obj_statuses->pushSelectBox();
        $configs = config('dragonknight.libfiles');

        $data = array_merge($this->data, array(
            'comments' => $comments,
            'statuses' => array_merge(array(0 => trans('tasks.task_select_all')), $statuses->toArray()),
            'request' => $request,
            'configs' => $configs
        ));

        return View::make('laravel-authentication-acl::admin.comments.list-comments')->with(['data' => $data]);
    }

    /**
     *
     */
    public function manageContextComments(Request $request) {

        $obj_comments = new Comments();
        $obj_statuses = new Statuses();


        $comment_id = $request->get('id');
        $comment = $obj_comments->find($comment_id);

        if ($comment) {

            $context_comments = $obj_comments->getContextComments($comment);

            $data = array_merge($this->data, array(
                'request' => $request,
                'comments' => $context_comments
            ));
            return View::make('laravel-authentication-acl::admin.comments.context-comments')->with(['data' => $data]);
        } else {
            return Redirect::route("comments.list")->withMessage(trans('re.not_found'));
        }
    }

    /**
     * - Update existing task
     * - Add new task
     * @Check validator
     * @Upload multiple image
     */
    public function postEditComment(Request $request) {
        var_dump(34);
        die();
        $libFiles = new LibFiles();
        $validator = new TaskValidator();

        $obj_tasks = new Tasks();
        $obj_users_tasks = new UsersTasks();

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

                /**
                 * Assign task
                 */
                $obj_users_tasks->assignTask(@$input['user_ids'], @$input['status_ids'], $task->task_id);
                return Redirect::route("tasks.list")->withMessage(trans('tasks.task_edit_successful'));
            } elseif (empty($task_id)) {
                //add
                $params = array_merge($input, $fileinfo);
                $task = $obj_tasks->addTask($params);

                /**
                 * Assign task
                 */
                $obj_users_tasks->assignTask(@$input['user_ids'], @$input['status_ids'], $task->task_id);
                return Redirect::route("tasks.edit", ["id" => $task->task_id])->withMessage(trans('tasks.task_add_successful'));
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
    public function deleteComment(Request $request) {
        var_dump(54);
        die();
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
