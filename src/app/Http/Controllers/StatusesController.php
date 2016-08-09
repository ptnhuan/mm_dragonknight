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

class StatusesController extends Controller {

    public $data = array();

    /**
     *
     */
    public function getList(Request $request) {
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
    public function editStatus(Request $request) {
        $obj_statuses = new Statuses();

        $status_id = $request->get('id'); 
        $status = $obj_statuses->findStatusId($status_id);
        if ($status) {
            $data = array_merge($this->data, array(
                'status' => $status,
                'request' => $request,
            ));
            return View::make('laravel-authentication-acl::admin.statuses.form-status')->with(['data' => $data]);
        } else {
            return Redirect::route("statuses.list")->withMessage(trans('re.not_found'));
        }
    }

    /**
     *
     */
    public function postEditStatus() {
        echo 'postEditTask';
    }

    /**
     *
     */
    public function deleteTask() {
        echo 'deleteTask';
    }

}
