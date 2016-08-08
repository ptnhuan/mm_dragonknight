<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

use View, Request;

/**
 * Models
 */
use App\Http\Models\Tasks;

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

        return View::make('laravel-authentication-acl::admin.tasks.list')->with(['data' => $data]);
    }

     /**
     *
     */
    public function editTask(){
        echo 'editTask';

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
