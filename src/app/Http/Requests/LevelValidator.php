<?php namespace App\Http\Requests;

use Event;
use \LaravelAcl\Library\Validators\AbstractValidator;

class LevelValidator extends AbstractValidator
{
    protected static $rules = array(
        'level_title' => 'required',
        'level_overview' => 'required',
        'level_description' => 'required',
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
            'level_title.required' => trans('levels.level_required_title'),
            'level_overview.required' => trans('levels.level_required_overview'),
            'level_description.required' => trans('levels.level_required_description'),
        ];
    }

}