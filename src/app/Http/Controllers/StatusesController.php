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
use App\Http\Models\Statuses;

class StatusesController extends Controller
{

    public $data = array();
    /**
     *
     */
    public function getList(Request $request){
        $obj_statuses = new Statuses();
        
        $statuses = $obj_statuses->getList();
        $data = array_merge($this->data, array(
            'statuses' => $statuses,
            'request' => $request,
        ));

        return View::make('laravel-authentication-acl::admin.statuses.list-statuses')->with(['data' => $data]);
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
