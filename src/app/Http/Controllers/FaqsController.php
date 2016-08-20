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
use App\Http\Models\Statuses;
use App\Http\Models\Categories;
use App\Http\Models\Faqs;
use App\Http\Models\Likes;
/**
 * Libraries
 */
use App\Http\Libraries\LibFiles;
/**
 * Validator
 */
use Validator;
use App\Http\Requests\FaqValidator;
use Response;
use Illuminate\Support\MessageBag as MessageBag;

class FaqsController extends Controller {

    public $data = array();

    /**
     *
     */
    public function getList(Request $request) {
        $obj_faq = new Faqs();

        $obj_statuses = new Statuses;
        $search = $request->all();
        $faq = $obj_faq->getList($search);
        $statuses = $obj_statuses->pushSelectBox();

        $data = array_merge($this->data, array(
            'faq' => $faq,
            'statuses' => array_merge(array(0 => 'None'), $statuses->toArray()),
            'request' => $request,
        ));
        return View::make('laravel-authentication-acl::admin.faqs.list-faqs')->with(['data' => $data]);
    }

    /**
     *
     */
    public function editFaq(Request $request) {
        $obj_faq = new Faqs();

        $obj_statuses = new Statuses;

        $faq_id = $request->get('id');

        $faq = $obj_faq->findFaqId($faq_id);

        $errors = $request->session()->get('errors', null);
        $message = $request->session()->get('message', FALSE);
        $input = $request->session()->get('input', null);

        $request->session()->forget('errors');
        $request->session()->forget('message');
        $request->session()->forget('input');
        $configs = config('dragonknight.libfiles');
        if ($faq) {
            $data = array_merge($this->data, array(
                'faq' => $faq,
                'statuses' => $obj_statuses->pushSelectBox(),
                'request' => $request,
                'errors' => $errors,
                'input' => $input,
                'message' => $message,
                'configs' => $configs,
            ));
            return View::make('laravel-authentication-acl::admin.faqs.form-faq')->with(['data' => $data]);
        } else if (is_null($faq_id)) {
            $data = array_merge($this->data, array(
                'faq' => $faq,
                'statuses' => $obj_statuses->pushSelectBox(),
                'request' => $request,
                'errors' => $errors,
                'input' => $input,
                'message' => $message,
                'configs' => $configs,
            ));
            return View::make('laravel-authentication-acl::admin.faqs.form-faq')->with(['data' => $data]);
        } else {
            return Redirect::route("faqs.list")->withMessage(trans('re.not_found'));
        }
    }

    /**
     *
     */
    public function viewFaq(Request $request) {
        $obj_faq = new Faqs();

        $obj_statuses = new Statuses;

        $faq_id = $request->get('id');

        $faq = $obj_faq->findFaqId($faq_id);

        $configs = config('dragonknight.context_ids');

        if ($faq) {

            $faq_answers = $obj_faq->getFaqAnswers($faq);

            $authentication = \App::make('authenticator');
            $current_user = $authentication->getLoggedUser();

            $data = array_merge($this->data, array(
                'faq' => $faq,
                'faq_answers' => $faq_answers,
                'statuses' => $obj_statuses->pushSelectBox(),
                'request' => $request,
                'context_id' => $configs['faq'],
                'current_user' => $current_user
            ));
            return View::make('laravel-authentication-acl::admin.faqs.view-faq-answers')->with(['data' => $data]);
        } else {
            return Redirect::route("faqs.list")->withMessage(trans('re.not_found'));
        }
    }

    /**
     *
     */
    public function postEditFaq(Request $request) {
        $libFiles = new LibFiles();

        $validator = new FaqValidator;

        $obj_faq = new Faqs();

        $input = $request->all();

        $faq_id = $request->get('id');

        $faq = $obj_faq->findFaqId($faq_id);
        /**
         * Validator value
         */
        if (!empty($validator->validate($input))) {//lúc này nó trả giá trị là false nên nó sẽ k vào trong này, bỏ qua
            //lúc này nó xác nhận giá trị nè, nó kiểm tra $input nó có giá trị hay k , lúc nãy kiểm tra là nó có giá trị, nên nó sẽ vào trong này
            /**
             * Upload file images
             * check: extension, size
             */
            $fileinfo = array(); //cái này thì nó tạo mảng thôi
            if (!empty($input['image'])) {//lúc này nó kiểm tra thử trong $input nó có thông tin của cái hình k , thông tin của cái hình k có nó k vào
                $configs = config('dragonknight.libfiles');
                $file = $request->file('image');
                $fileinfo = $libFiles->upload($configs['faq'], $file);
            } else {
                $fileinfo['filename'] = ''; //lúc này nó gán cho cái filename của mảng $fileinfo giá trị k có j hết =)), khúc này t cũng k hỉu lắm
            }
            //TODO: Check
            $input = array_merge($input, $fileinfo); //nó gộp 2 mảng lại với nhau, mảng $fininof thi k biết nó ntn nên giờ vardump xem thử
            /**
             * VALID
             */
            if ($faq) {
                if (empty($fileinfo['filename']) && $input['is_file']) {
                    $input['filename'] = $faq->faq_image;
                }
                //edit
                $params = array_merge($fileinfo, $input);
                $obj_faq->updateFaq($params);
                return Redirect::route("faqs.list")->withMessage(trans('faqs.faq_edit_successful'));
            } elseif (empty($faq_id)) {
                //add
                $params = array_merge($input, $fileinfo);
                $faq = $obj_faq->addFaq($params);
                return Redirect::route("faqs.edit", ["id" => $faq->faq_id])->withMessage(trans('faqs.faq_add_successful'));
            } else {
                //error
            }
        } else {
            /**
             * UNVALID
             */
            //nó chạy xuống đây,ở trên đó có nghĩa là nó yêu cầu đầy đủ giá trị rồi nó mới vào
            //lúc này nó k đầy đủ, có nghĩa là trong 3 cái giá trị đó chưa nhập xong
            $errors = $validator->getErrors(); //cái này nó trả giá trị lỗi nè, nos trar giá trị lúc này là tiêu đề
            if (!empty($faq_id)) {//lúc này nó rỗng
                $request->session()->put('errors', $errors);
                $request->session()->put('message', true);
                $request->session()->put('input', $request->all());

                return Redirect::route("faqs.edit", ["id" => $faq_id]);
            } else {//nó chạy xuống đây
                $request->session()->put('errors', $errors);
                $request->session()->put('message', true);
                $request->session()->put('input', $request->all());
                //3 cái đó là nó ghi giá trị lỗi vào 'error', nói chung là nó ghi giá trị rồi nó truyền lên thằng getEdit
                return Redirect::route("faqs.edit");
            }
        }
    }

    /**
     *
     */
    public function deleteFaq(Request $request) {
        $obj_faq = new Faqs();

        $faq_id = $request->get('id');
        $faq = $obj_faq->findFaqId($faq_id);

        if ($faq) {

            $obj_faq->deleteFaqById($faq_id);
            return Redirect::route("faqs.list")->withMessage(trans('faqs.faq_delete_successful'));
        } else {
            return Redirect::route("faqs.list")->withMessage(trans('faqs.faq_delete_unsuccessful'));
        }
    }

    /**
     *
     * @param Request $request
     */
    public function ajax_faq_like(Request $request) {
        if ($request->ajax()) {
            $input = $request->all();
            $obj_likes = new Likes();
            $obj_faq = new Faqs();
            $obj_faq->likeItem($input);
            $likes = $obj_likes->likeItem($input);
            if ($likes) {
                return json_encode(TRUE);
            }
        }
        return json_encode(FALSE);
    }

}
