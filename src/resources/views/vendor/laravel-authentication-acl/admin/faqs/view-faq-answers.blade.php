@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
Admin area: Groups list
@stop

@section('content')

<?php
    $faq = @$data['faq'];
    $faq_answers = @$data['faq_answers']
?>
<div class="row">
    <div class="col-md-12">
            {{-- print messages --}}
            <?php $message = Session::get('message'); ?>
            @if( isset($message) )
            <div class="alert alert-success">{!! $message !!}</div>
            @endif
            {{-- print errors --}}
            @if($errors && ! $errors->isEmpty() )
            @foreach($errors->all() as $error)
            <div class="alert alert-danger">{!! $error !!}</div>
            @endforeach
            @endif
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title bariol-thin"><i class="fa fa-group">
                        </i> {!! 1 ? trans('faqs.faq_page') : 'Groups' !!}
                    </h3>
                </div>
                <div class="panel-body">
                    @include('laravel-authentication-acl::admin.faqs.view-faq-answers-item')
                </div>
            </div>
    </div>
</div>
@stop
