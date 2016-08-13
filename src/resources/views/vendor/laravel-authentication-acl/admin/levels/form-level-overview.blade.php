<?php
$messages = array(
    'level_title' => '',
    'level_overview' => '',
    'level_description' => '',
);
$errors = @$data['errors'];

if ($errors && !empty($errors->first('level_title'))) {
    $messages['level_title'] = $errors->first('level_title');
}
if ($errors && !empty($errors->first('level_overview'))) {
    $messages['level_overview'] = $errors->first('level_overview');
}
if ($errors &&  !empty($errors->first('level_description'))) {
    $messages['level_description'] = $errors->first('level_description');
}

?>
<!-- TASK TITLE -->
<div class="form-group">
    {!! Form::label('level_title', trans('levels.level_title').':') !!}
    {!! Form::text('level_title', @$level->level_title, ['class' => 'form-control', 'placeholder' => trans('levels.level_title').'']) !!}
    <span class="text-danger">{!! $messages['level_title'] !!}</span>
</div>

<!-- TASK OVERVIEW -->
<div class="form-group">
    {!! Form::label('level_overview', trans('levels.level_overview').':') !!}
    {!! Form::text('level_overview', @$level->level_overview, ['class' => 'form-control', 'placeholder' => trans('levels.level_overview').'']) !!}
    <span class="text-danger">{!! $messages['level_overview'] !!}</span>
</div>

<!-- TASK DESCRIPTION   -->
<div class="form-group">
    {!! Form::label('level_description', trans('levels.level_description').':') !!}
    {!! Form::text('level_description', @$level->level_description, ['class' => 'form-control', 'placeholder' => trans('levels.level_description').'']) !!}
    <span class="text-danger">{!! $messages['level_description'] !!}</span>
</div>