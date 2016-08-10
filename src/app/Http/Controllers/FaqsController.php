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
use App\Http\Models\Categories;
use App\Http\Models\Faqs;

class FaqsController extends Controller
{

    public $data = array();
    /**
     *
     */
    public function getList(Request $request){


        $obj_faqs = new Faqs();
        $faqs = $obj_faqs->getList();

        $data = array_merge($this->data, array(
            'faqs' => $faqs,
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
            
            //Update for existing faq
            $data = array_merge($this->data, array(
                'faq' => $faq,
                'statuses' => $obj_statuses->pushSelectBox(),
                'request' => $request,
            ));
            return View::make('laravel-authentication-acl::admin.faqs.form-faq')->with(['data' => $data]);
        
            
        } else if (is_null($faq_id)) {
            //Add new faq
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
    public function postEditFaq(Request $request){
        var_dump($request->all());
        die();
                echo 'postEditTask';


    }

     /**
     *
     */
    public function deleteTask(){
                echo 'deleteTask';


    }

}
