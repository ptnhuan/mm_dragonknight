<?php namespace App\Http\Requests;

use Event;
use \LaravelAcl\Library\Validators\AbstractValidator;

class TaskValidator extends AbstractValidator
{
    protected static $rules = array(
        'task_title' => 'required',
        'task_overview' => 'required',
        'task_description' => 'required',
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
            'task_title.required' => trans('tasks.task_required_title'),
            'task_overview.required' => trans('tasks.task_required_overview'),
            'task_description.required' => trans('tasks.task_required_description'),
        ];
    }

}