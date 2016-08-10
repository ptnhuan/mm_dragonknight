@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
Admin area: edit group
@stop

@section('content')

<?php $task = @$data['task']; ?>

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
                <h3 class="panel-title bariol-thin">{!! !empty(@$task->task_id) ? '<i class="fa fa-pencil"></i> Edit' : '<i class="fa fa-users"></i> Create' !!} group</h3>
            </div>

            <div class="panel-body">
                <div class="row">

                    <!--FORM TASK-->
                    <div class="col-md-12 col-xs-12">
                        {{-- group base form --}}
                        <h4>General data</h4>
                        {!! Form::model($task, [ 'url' => [URL::route('tasks.edit'), @$task->task_id], 'method' => 'post'] ) !!}


                        <!-- TASK TITLE -->
                        <div class="form-group">
                            {!! Form::label('task_title', trans('tasks.task_title').': *') !!}
                            {!! Form::text('task_title', @$task->task_title, ['class' => 'form-control', 'placeholder' => 'group name']) !!}
                            <span class="text-danger">{!! $errors->first('name') !!}</span>

                        </div>

                        <!-- TASK ID HIDDEN -->
                        {!! Form::hidden('id') !!}
                        <a href="{!! URL::route('tasks.delete',['id' => @$task->task_id, '_token' => csrf_token()]) !!}" class="btn btn-danger pull-right margin-left-5 delete">Delete</a>
                        {!! Form::submit('Save', array("class"=>"btn btn-info pull-right ")) !!}
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
        return confirm("Are you sure to delete this item?");
    });
</script>
@stop