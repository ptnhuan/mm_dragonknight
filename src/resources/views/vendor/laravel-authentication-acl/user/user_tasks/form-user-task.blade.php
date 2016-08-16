@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
<?php echo trans('tasks.task_edit_page_title') ?>
@stop

@section('content')



<?php
$user_task = @$data['user_task'];

?>

<div class="row">
    <div class="col-md-12">
        {{-- model general errors from the form --}}

        @if(@$data['errors'] )
            <div class="alert alert-danger">{!! trans('tasks.task_unsuccessful') !!}</div>
        @elseif (@$data['message'])
            <div class="alert alert-success">{!! trans('tasks.task_successful') !!}</div>
        @endif



        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title bariol-thin">{!! !empty(@$user_task->task_id) ? '<i class="fa fa-pencil"></i> '.trans('tasks.task_edit') : '<i class="fa fa-users"></i> '.trans('tasks.task_create') !!} <?php echo trans('tasks.task_name') ?></h3>
            </div>

            <div class="panel-body">
                <div class="row">

                    <!--FORM TASK-->
                    <div class="col-md-12 col-xs-12">

                        {{-- group base form --}}

                        {!! Form::open(['route'=>['user_tasks.edit'],  'files'=>true, 'method' => 'post'])  !!}


                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#home">{!! trans('tasks.task_tab_overview') !!}</a></li>
                            <li><a data-toggle="tab" href="#menu1">{!! trans('tasks.task_tab_attributes') !!}</a></li>
                        </ul>

                        <div class="tab-content">

                            <!--TASK OVERVIEW-->
                            <div id="home" class="tab-pane fade in active">
                                @include('laravel-authentication-acl::user.user_tasks.form-user-task-description')
                            </div>

                            <!--TASK ATTRIBUTES-->
                            <div id="menu1" class="tab-pane fade">
                               @include('laravel-authentication-acl::user.user_tasks.form-user-task-description')
                            </div>

                        </div>

                        <!-- TASK ID HIDDEN -->
                        {!! Form::hidden('id',@$user_task->user_task_id) !!}
                        {!! Form::submit(trans('tasks.task_save').'', array("class"=>"btn btn-info pull-right ")) !!}
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@stop
