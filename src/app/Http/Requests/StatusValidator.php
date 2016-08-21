<?php namespace App\Http\Requests;

use Event;
use \LaravelAcl\Library\Validators\AbstractValidator;

class StatusValidator extends AbstractValidator
{
    protected static $rules = array(
        'status_title' => 'required',
        'status_description' => 'required',
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
            'status_title.required' => trans('statuses.status_required_title'),
            'status_description.required' => trans('statuses.status_required_description'),
        ];
    }

}