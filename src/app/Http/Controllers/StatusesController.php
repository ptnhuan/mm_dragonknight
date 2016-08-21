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
 * Validator
 */
use App\Http\Requests\StatusValidator;
/**
 * Libraries
 */
use App\Http\Libraries\LibFiles;

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


        $errors = $request->session()->get('errors', null);
        $message = $request->session()->get('message', FALSE);
        $input = $request->session()->get('input', null);

        $request->session()->forget('errors');
        $request->session()->forget('message');
        $request->session()->forget('input');
        $configs = config('dragonknight.libfiles');

        if ($status) {
            $data = array_merge($this->data, array(
                'status' => $status,
                'request' => $request,
                'errors' => $errors,
                'input' => $input,
                'message' => $message,
                'configs' => $configs,
            ));
            return View::make('laravel-authentication-acl::admin.statuses.form-status')->with(['data' => $data]);
        } else if (is_null($status_id)) {

            $data = array_merge($this->data, array(
                'status' => null,
                'statuses' => $obj_statuses->pushSelectBox(),
                'request' => $request,
                'errors' => $errors,
                'input' => $input,
                'message' => $message,
                'configs' => $configs,
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
        $libFiles = new LibFiles();
        
        $validator = new StatusValidator();

        $obj_statuses = new Statuses();

        $input = $request->all();

        $status_id = $request->get('id');

        $status = $obj_statuses->findStatusId($status_id);
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
                $fileinfo = $libFiles->upload($configs['status'], $file);
            } else {
                $fileinfo['filename'] = '';
            }
            //TODO: check
            $input = array_merge($input, $fileinfo);

            /**
             * VALID
             */
            if ($status) {
                if (empty($fileinfo['filename']) && $input['is_file']) {
                    $input['filename'] = $status->status_image;
                } 
                //edit
                $params = array_merge($fileinfo, $input);

                $obj_statuses->updateStatus($params);

                return Redirect::route("statuses.list")->withMessage(trans('statuses.status_edit_successful'));
            } elseif (empty($status_id)) {
                //add
                $params = array_merge($input, $fileinfo);
               
                $status = $obj_statuses->addStatus($params);

                return Redirect::route("statuses.edit", ["id" => $status->status_id])->withMessage(trans('statuses.status_add_successful'));
            } else {
                //error
            }
        } else {
            /**
             * UNVALID
             */
            $errors = $validator->getErrors();
            if (!empty($status_id)) {

                $request->session()->put('errors', $errors);
                $request->session()->put('message', true);
                $request->session()->put('input', $request->all());

                return Redirect::route("statuses.edit", ["id" => $status_id]);
            } else {
                $request->session()->put('errors', $errors);
                $request->session()->put('message', true);
                $request->session()->put('input', $request->all());
                return Redirect::route("statuses.edit");
            }
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
