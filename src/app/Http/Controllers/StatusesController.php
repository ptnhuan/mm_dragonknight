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

class StatusesController extends Controller {

    public $data = array();

    /**
     *
     */
    public function getList(Request $request) {
        $obj_statuses = new Statuses;

        $search = $request->all();

        $statuses = $obj_statuses->getList($search); 


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
        } else if (is_null($status_id)) {

            $data = array_merge($this->data, array(
                'status' => null,
                'statuses' => $obj_statuses->pushSelectBox(),
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
    public function postEditStatus(Request $request) {
        $obj_statuses = new Statuses();

        $input = $request->all();

        $status_id = $request->get('id');

        $status = $obj_statuses->findStatusId($status_id);

        if ($status) {
            //edit
            $obj_statuses->updateStatus($input);
            return Redirect::route("statuses.list")->withMessage(trans('statuses.status_edit_successful'));
        } elseif (empty($status_id)) {
            //add
            $obj_statuses->addStatus($input);
            return Redirect::route("statuses.list")->withMessage(trans('statuses.status_edit_successful'));
        } else {
            //error
        }
    }

    /**
     *
     */
    public function deleteStatus(Request $request) {
        $obj_statuses = new Statuses();

        $status_id = $request->get('id');
        $status = $obj_statuses->findStatusId($status_id);

        if ($status) {

            $obj_statuses->deleteStatusById($status_id);
            return Redirect::route("statuses.list")->withMessage(trans('statuses.status_delete_successful'));
        } else {
            return Redirect::route("statuses.list")->withMessage(trans('statuses.status_delete_unsuccessful'));
        }
    }

}
