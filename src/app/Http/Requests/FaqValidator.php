<?php namespace App\Http\Requests;

use Event;
use \LaravelAcl\Library\Validators\AbstractValidator;

class FaqValidator extends AbstractValidator
{
    protected static $rules = array(
        'faq_title' => 'required',
        'faq_overview' => 'required',
        'faq_description' => 'required',
    );

    protected static $messages = [
        'required' => ':attribute yêu cầu nhập',
    ];


    public function __construct()
    {
        Event::listen('validating', function($input)
        {
        });
        $this->messages();
    }
    public function validate($input) {

        $flag = parent::validate($input);

        return $flag;
    }


    public function messages() {
        self::$messages = [
            'faq_title.required' => trans('faqs.faq_required_title'),
            'faq_overview.required' => trans('faqs.faq_required_overview'),
            'faq_description.required' => trans('faqs.faq_required_description'),
        ];
    }

}