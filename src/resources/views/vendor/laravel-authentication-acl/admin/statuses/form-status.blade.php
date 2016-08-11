@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
<?php echo trans('statuses.status_edit_page_title') ?>
@stop

@section('content')

<?php
$status = @$data['status'];
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
                <h3 class="panel-title bariol-thin">{!! !empty(@$status->status_id) ? '<i class="fa fa-pencil"></i> '.trans('statuses.status_edit') : '<i class="fa fa-users"></i> '.trans('statuses.status_create') !!} <?php echo trans('statuses.status_name') ?></h3>
            </div>

            <div class="panel-body">
                <div class="row">

                    <!--FORM STATUS-->
                    <div class="col-md-12 col-xs-12">

                        {{-- group base form --}}

                        {!! Form::model($status, [ 'url' => [URL::route('statuses.edit'), @$status->status_id], 'method' => 'post'] ) !!}

                        <!-- STATUSES TITLE -->
                        <div class="form-group">
                            {!! Form::label('status_title', trans('statuses.status_title').':') !!}
                            {!! Form::text('status_title', @$status->status_title, ['class' => 'form-control', 'placeholder' => trans('statuses.status_title').'']) !!}
                            <span class="text-danger">{!! $errors->first('status_title') !!}</span>
                        </div>

                        <!-- STATUSES DESCRIPTION -->
                        <div class="form-group">
                            {!! Form::label('status_description', trans('statuses.status_description').':') !!}
                            {!! Form::text('status_description', @$statuxs->status_description, ['class' => 'form-control', 'placeholder' => trans('statuses.status_description').'']) !!}
                            <span class="text-danger">{!! $errors->first('status_description') !!}</span>
                        </div> 

                        <!-- STATUSES ID HIDDEN -->
                        {!! Form::hidden('id',@$status->status_id) !!}
                        <a href="{!! URL::route('statuses.delete',['id' => @$status->status_id, '_token' => csrf_token()]) !!}" class="btn btn-danger pull-right margin-left-5 delete"><?php echo trans('statuses.status_delete') ?></a>
                        {!! Form::submit(trans('statuses.status_save').'', array("class"=>"btn btn-info pull-right ")) !!}
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
        return confirm("<?php  echo trans('statuses.status_delete_confirm')?>");
    });
</script>
@stop