@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
<?php echo trans('faqs.faq_edit_page_title') ?>
@stop

@section('content')

<?php
$faq = @$data['faq'];
?>

<div class="row">
    <div class="col-md-12">
        {{-- model general errors from the form --}}
        @if($errors->has('model') )
        <div class="alert alert-danger">{!! $errors->first('model') !!}</div>
        @endif

        {{-- successful message --}}
        <?php $message = Session::get('message'); ?>
        @if( isset($message) )
        <div class="alert alert-success">{{$message}}</div>
        @endif

        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title bariol-thin">{!! !empty(@$faq->faq_id) ? '<i class="fa fa-pencil"></i> '.trans('faqs.faq_edit') : '<i class="fa fa-users"></i> '.trans('faqs.faq_create') !!} <?php echo trans('faqs.faq_name') ?></h3>
            </div>

            <div class="panel-body">
                <div class="row">

                    <!--FORM TASK-->
                    <div class="col-md-12 col-xs-12">

                        {{-- group base form --}}

                        {!! Form::model($faq, [ 'url' => [URL::route('faqs.edit'), @$faq->faq_id], 'method' => 'post'] ) !!}


                        <!-- TASK TITLE -->
                        <div class="form-group">
                            {!! Form::label('faq_title', trans('faqs.faq_title').':') !!}
                            {!! Form::text('faq_title', @$faq->faq_title, ['class' => 'form-control', 'placeholder' => trans('faqs.faq_title').'']) !!}
                            <span class="text-danger">{!! $errors->first('faq_title') !!}</span>
                        </div>
                        <!-- TASK STATUS -->
                        <div class="form-group">
                            {!! Form::label('status_id', trans('faqs.faq_status').':') !!}
                            {!! Form::select('status_id', @$data['statuses'], @$faq->status_id, ['class' => 'form-control']) !!}

                            <span class="text-danger">{!! $errors->first('status_id') !!}</span>
                        </div>

                        <!-- TASK ID HIDDEN -->
                        {!! Form::hidden('id',@$faq->faq_id) !!}
                        <a href="{!! URL::route('faqs.delete',['id' => @$faq->faq_id, '_token' => csrf_token()]) !!}" class="btn btn-danger pull-right margin-left-5 delete"><?php echo trans('faqs.faq_delete') ?></a>
                        {!! Form::submit(trans('faqs.faq_save').'', array("class"=>"btn btn-info pull-right ")) !!}
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@stop

@section('footer_scripts')
<script>
    $(".delete").click(function () {
        return confirm("<?php  echo trans('faqs.faq_delete_confirm')?>");
    });
</script>
@stop