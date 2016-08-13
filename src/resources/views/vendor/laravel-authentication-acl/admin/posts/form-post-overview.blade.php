<?php
$messages = array(
    'post_title' => '',
    'post_overview' => '',
    'post_description' => '',
);
$errors = @$data['errors'];
if ($errors && !empty($errors->first('post_title'))) {
    $messages['post_title'] = $errors->first('post_title');
}
if ($errors && !empty($errors->first('post_overview'))) {
    $messages['post_overview'] = $errors->first('post_overview');
}
if ($errors &&  !empty($errors->first('post_description'))) {
    $messages['post_description'] = $errors->first('post_description');
}

?>
<!-- POST TITLE -->
<div class="form-group">
    {!! Form::label('post_title', trans('posts.post_title').':') !!}
    {!! Form::text('post_title', @$post->post_title, ['class' => 'form-control', 'placeholder' => trans('posts.post_title').'']) !!}
    <span class="text-danger">{!! $messages['post_title'] !!}</span>
</div>

<!-- POST OVERVIEW -->
<div class="form-group">
    {!! Form::label('post_overview', trans('posts.post_overview').':') !!}
    {!! Form::text('post_overview', @$post->post_overview, ['class' => 'form-control', 'placeholder' => trans('posts.post_overview').'']) !!}
    <span class="text-danger">{!! $messages['post_overview'] !!}</span>
</div>

<!-- POST DESCRIPTION   -->
<div class="form-group">
    {!! Form::label('post_description', trans('posts.post_description').':') !!}
    {!! Form::text('post_description', @$post->post_description, ['class' => 'form-control', 'placeholder' => trans('posts.post_description').'']) !!}
    <span class="text-danger">{!! $messages['post_description'] !!}</span>
</div>