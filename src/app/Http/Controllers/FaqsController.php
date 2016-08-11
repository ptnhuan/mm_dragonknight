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
use App\Http\Models\Faqs;
use App\Http\Models\Statuses;

class FaqsController extends Controller {

    public $data = array();

    /**
     *
     */
    public function getList(Request $request) {

        $obj_faqs = new Faqs();
        $obj_statuses = new Statuses;

        $search = $request->all();
        
        $faqs = $obj_faqs->getList($search);
        $statuses = $obj_statuses->pushSelectBox();
         
        $data = array_merge($this->data, array(
            'faqs' => $faqs,
            'statuses' => $statuses->toArray(),
            'request' => $request,
        )); 

        return View::make('laravel-authentication-acl::admin.faqs.list-faqs')->with(['data' => $data]);
    }   

    /**
     *
     */
    public function editFaq(Request $request) {
        $obj_faqs = new Faqs();
        $obj_statuses = new Statuses;

        $faq_id = $request->get('id');
        $faq = $obj_faqs->findFaqId($faq_id);
        if ($faq) {
            $data = array_merge($this->data, array(
                'faq' => $faq,
                'statuses' => $obj_statuses->pushSelectBox(),
                'request' => $request,
            ));
            return View::make('laravel-authentication-acl::admin.faqs.form-faq')->with(['data' => $data]);
        } else if (is_null($faq_id)) {

            $data = array_merge($this->data, array(
                'faq' => null,
                'statuses' => $obj_statuses->pushSelectBox(),
                'request' => $request,
            ));
            return View::make('laravel-authentication-acl::admin.faqs.form-faq')->with(['data' => $data]);
        } else {

            return Redirect::route("faqs.list")->withMessage(trans('re.not_found'));
        }
    }

    /**
     *
     */
    public function postEditFaq(Request $request) {

        $obj_faqs = new Faqs();

        $input = $request->all();

        $faq_id = $request->get('id');

        $faq = $obj_faqs->findFaqId($faq_id);

        if ($faq) {
            //edit

            $obj_faqs->updateFaq($input);
            return Redirect::route("faqs.list")->withMessage(trans('faqs.faq_edit_successful'));
        } elseif (empty($faq_id)) {
            //add
            $obj_faqs->addFaq($input);
            return Redirect::route("faqs.list")->withMessage(trans('faqs.faq_edit_successful'));
        } else {
            //error
        }
    }

    /**
     *
     */
    public function deleteFaq(Request $request) {
        $obj_faqs = new Faqs();

        $faq_id = $request->get('id');
        $faq = $obj_faqs->findFaqId($faq_id);

        if ($faq) {

            $obj_faqs->deleteFaqById($faq_id);
            return Redirect::route("faqs.list")->withMessage(trans('faqs.faq_delete_successful'));
        } else {
            return Redirect::route("faqs.list")->withMessage(trans('faqs.faq_delete_unsuccessful'));
        }
    }

}
