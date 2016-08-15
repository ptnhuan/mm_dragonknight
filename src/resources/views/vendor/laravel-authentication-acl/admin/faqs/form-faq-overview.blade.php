<?php
$messages = array(
    'faq_title' => '',
    'faq_overview' => '',
    'faq_description' => '',
);
$errors = @$data['errors'];
if ($errors && !empty($errors->first('faq_title'))) {
    $messages['faq_title'] = $errors->first('faq_title');
}
if ($errors && !empty($errors->first('faq_overview'))) {
    $messages['faq_overview'] = $errors->first('faq_overview');
}
if ($errors &&  !empty($errors->first('faq_description'))) {
    $messages['faq_description'] = $errors->first('faq_description');
}

?>
<!-- POST TITLE -->
<div class="form-group">
    {!! Form::label('faq_title', trans('faqs.faq_title').':') !!}
    {!! Form::text('faq_title', @$faq->faq_title, ['class' => 'form-control', 'placeholder' => trans('faqs.faq_title').'']) !!}
    <span class="text-danger">{!! $messages['faq_title'] !!}</span>
</div>

<!-- POST OVERVIEW -->
<div class="form-group">
    {!! Form::label('faq_overview', trans('faqs.faq_overview').':') !!}
    {!! Form::text('faq_overview', @$faq->faq_overview, ['class' => 'form-control', 'placeholder' => trans('faqs.faq_overview').'']) !!}
    <span class="text-danger">{!! $messages['faq_overview'] !!}</span>
</div>

<!-- POST DESCRIPTION   -->
<div class="form-group">
    {!! Form::label('faq_description', trans('faqs.faq_description').':') !!}
    {!! Form::text('faq_description', @$faq->faq_description, ['class' => 'form-control', 'placeholder' => trans('faqs.faq_description').'']) !!}
    <span class="text-danger">{!! $messages['faq_description'] !!}</span>
</div>