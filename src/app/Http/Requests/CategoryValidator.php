<?php namespace App\Http\Requests;

use Event;
use \LaravelAcl\Library\Validators\AbstractValidator;

class CategoryValidator extends AbstractValidator
{
    protected static $rules = array(
        'category_title' => 'required',
        'category_overview' => 'required',
        'category_description' => 'required',
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
            'category_title.required' => trans('categories.category_required_title'),
            'category_overview.required' => trans('categories.category_required_overview'),
            'category_description.required' => trans('categories.category_required_description'),
        ];
    }

}