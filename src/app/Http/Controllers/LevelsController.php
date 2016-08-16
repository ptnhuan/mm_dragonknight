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
use App\Http\Models\Levels;
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
use App\Http\Requests\LevelValidator;

class LevelsController extends Controller {

    public $data = array();

    /**
     *
     */
    public function getList(Request $request) {

        $obj_levels = new Levels();
        $obj_statuses = new Statuses;

        $search = $request->all();

        $levels = $obj_levels->getList($search);

        $statuses = $obj_statuses->pushSelectBox();

        $data = array_merge($this->data, array(
            'levels' => $levels,
            'request' => $request,
        ));

        return View::make('laravel-authentication-acl::admin.levels.list-levels')->with(['data' => $data]);
    }

    /**
     *
     */
    public function editLevel(Request $request) {
        $obj_levels = new Levels();
        $obj_statuses = new Statuses;
        $level_id = $request->get('id');

        $level = $obj_levels->findLevelById($level_id);


        $errors = $request->session()->get('errors', null);
        $message = $request->session()->get('message', FALSE);
        $input = $request->session()->get('input', null);

        $request->session()->forget('errors');
        $request->session()->forget('message');
        $request->session()->forget('input');

        $configs = config('dragonknight.libfiles');

        if ($level) {
            $data = array_merge($this->data, array(
                'level' => $level,
                'statuses' => $obj_statuses->pushSelectBox(),
                'request' => $request,
                'errors' => $errors,
                'input' => $input,
                'message' => $message,
                'configs' => $configs,
            ));
            return View::make('laravel-authentication-acl::admin.levels.form-level')->with(['data' => $data]);
        } else if (is_null($level_id)) {
            $data = array_merge($this->data, array(
                'level' => $level,
                'statuses' => $obj_statuses->pushSelectBox(),
                'request' => $request,
                'errors' => $errors,
                'input' => $input,
                'message' => $message,
                'configs' => $configs,
            ));
            return View::make('laravel-authentication-acl::admin.levels.form-level')->with(['data' => $data]);
        } else {

            return Redirect::route("levels.list")->withMessage(trans('re.not_found'));
        }
    }

    /**
     *
     */
    public function postEditLevel(Request $request) {
        $libFiles = new LibFiles();
        $validator = new LevelValidator();

        $obj_levels = new Levels();

        $input = $request->all();

        $level_id = $request->get('id');

        $level = $obj_levels->findLevelById($level_id);

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
                $fileinfo = $libFiles->upload($configs['level'], $file);
            } else {
                $fileinfo['filename'] = '';
            }
            //TODO: check
            $input = array_merge($input, $fileinfo);
            /**
             * VALID
             */
            if ($level) {
                if (empty($fileinfo['filename']) && $input['is_file']) {
                    $input['filename'] = $level->level_image;
                }
                //edit
                $params = array_merge($fileinfo, $input);

                $obj_levels->updateLevel($params);
                return Redirect::route("levels.list")->withMessage(trans('levels.level_edit_successful'));
            } elseif (empty($level_id)) {
                //add
                $params = array_merge($input, $fileinfo);
                $obj_levels->addLevel($params);
                return Redirect::route("levels.list")->withMessage(trans('levels.level_edit_successful'));
            } else {
                //error
            }
        } else {
            /**
             * UNVALID
             */
            $errors = $validator->getErrors();

            if (!empty($level_id)) {
                $request->session()->put('errors', $errors);
                $request->session()->put('message', true);
                $request->session()->put('input', $request->all());
                return Redirect::route("levels.edit", ["id" => $level_id]);
            } else {
                $request->session()->put('errors', $errors);
                $request->session()->put('message', true);
                $request->session()->put('input', $request->all());
                return Redirect::route("levels.edit");
            }
        }
    }

    /**
     *
     */
    public function deleteLevel(Request $request) {
        $obj_levels = new Levels();

        $level_id = $request->get('id');
        $level = $obj_levels->findLevelById($level_id);

        if ($level) {

            $obj_levels->deleteLevelById($level_id);
            return Redirect::route("levels.list")->withMessage(trans('levels.level_delete_successful'));
        } else {
            return Redirect::route("levels.list")->withMessage(trans('levels.level_delete_unsuccessful'));
        }
    }

}
