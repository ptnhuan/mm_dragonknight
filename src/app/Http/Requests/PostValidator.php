<?php namespace App\Http\Requests;

use Event;
use \LaravelAcl\Library\Validators\AbstractValidator;

class PostValidator extends AbstractValidator
{
    protected static $rules = array(
        'post_title' => 'required',
        'post_overview' => 'required',
        'post_description' => 'required',
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
            'post_title.required' => trans('posts.post_required_title'),
            'post_overview.required' => trans('posts.post_required_overview'),
            'post_description.required' => trans('posts.post_required_description'),
        ];
    }

}