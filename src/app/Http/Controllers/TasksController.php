<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

use View,Redirect;
use Illuminate\Http\Request;
/**
 * Models
 */
use App\Http\Models\Tasks;
use App\Http\Models\Statuses;

class TasksController extends Controller
{

    public $data = array();
    /**
     *
     */
    public function getList(Request $request){


        $obj_tasks = new Tasks();
        $tasks = $obj_tasks->getList();

        $data = array_merge($this->data, array(
            'tasks' => $tasks,
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
                'task' => null,
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
    public function postEditTask(){
                echo 'postEditTask';


    }

     /**
     *
     */
    public function deleteTask(){
                echo 'deleteTask';


    }

}
