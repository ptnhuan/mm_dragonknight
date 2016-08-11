@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
<?php echo trans('tasks.task_edit_page_title') ?>
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
                <h3 class="panel-title bariol-thin">{!! !empty(@$task->task_id) ? '<i class="fa fa-pencil"></i> '.trans('tasks.task_edit') : '<i class="fa fa-users"></i> '.trans('tasks.task_create') !!} <?php echo trans('tasks.task_name') ?></h3>
            </div>

            <div class="panel-body">
                <div class="row">

                    <!--FORM TASK-->
                    <div class="col-md-12 col-xs-12">

                        {{-- group base form --}}

                        {!! Form::model($task, [ 'url' => [URL::route('tasks.edit'), @$task->task_id], 'method' => 'post'] ) !!}

                        <!-- TASK POINT -->
                        <div class="form-group">
                            {!! Form::label('task_point', trans('tasks.task_point').':') !!}
                            {!! Form::text('task_point', @$task->task_point, ['class' => 'form-control', 'placeholder' => trans('tasks.task_point').'']) !!}
                            <span class="text-danger">{!! $errors->first('task_point') !!}</span>
                        </div>

                        <!-- TASK TITLE -->
                        <div class="form-group">
                            {!! Form::label('task_title', trans('tasks.task_title').':') !!}
                            {!! Form::text('task_title', @$task->task_title, ['class' => 'form-control', 'placeholder' => trans('tasks.task_title').'']) !!}
                            <span class="text-danger">{!! $errors->first('task_title') !!}</span>
                        </div>

                        <!-- TASK OVERVIEW -->
                        <div class="form-group">
                            {!! Form::label('task_overview', trans('tasks.task_overview').':') !!}
                            {!! Form::text('task_overview', @$task->task_overview, ['class' => 'form-control', 'placeholder' => trans('tasks.task_overview').'']) !!}
                            <span class="text-danger">{!! $errors->first('task_overview') !!}</span>
                        </div>

                        <!-- TASK DESCRIPTION   -->
                        <div class="form-group">
                            {!! Form::label('task_description', trans('tasks.task_description').':') !!}
                            {!! Form::text('task_description', @$task->task_description, ['class' => 'form-control', 'placeholder' => trans('tasks.task_description').'']) !!}
                            <span class="text-danger">{!! $errors->first('task_description') !!}</span>
                        </div>

                        <!-- TASK NOTES   -->
                        <div class="form-group">
                            {!! Form::label('task_notes', trans('tasks.task_notes').':') !!}
                            {!! Form::text('task_notes', @$task->task_notes, ['class' => 'form-control', 'placeholder' => trans('tasks.task_notes').'']) !!}
                            <span class="text-danger">{!! $errors->first('task_notes') !!}</span>
                        </div>

                        <!-- TASK STATUS -->
                        <div class="form-group">
                            {!! Form::label('status_id', trans('tasks.task_status').':') !!}
                            {!! Form::select('status_id', @$data['statuses'], @$task->status_id, ['class' => 'form-control']) !!}

                            <span class="text-danger">{!! $errors->first('status_id') !!}</span>
                        </div>

                        <!-- TASK ID HIDDEN -->
                        {!! Form::hidden('id',@$task->task_id) !!}
                        <a href="{!! URL::route('tasks.delete',['id' => @$task->task_id, '_token' => csrf_token()]) !!}" class="btn btn-danger pull-right margin-left-5 delete"><?php echo trans('tasks.task_delete') ?></a>
                        {!! Form::submit(trans('tasks.task_save').'', array("class"=>"btn btn-info pull-right ")) !!}
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
        return confirm("<?php echo trans('tasks.task_delete_confirm') ?>");
    });
</script>
@stop