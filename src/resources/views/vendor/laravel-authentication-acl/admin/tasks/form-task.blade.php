@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
<?php echo trans('tasks.task_edit_page_title') ?>
@stop

@section('content')



<?php
$task = @$data['task'];
if (@$data['input']) {
    $task = new stdClass();
    $task->task_title = @$task->task_title?$task->task_title:$data['input']['task_title'];
    $task->task_overview = @$task->task_overview?$task->task_overview:$data['input']['task_overview'];
    $task->task_description = @$task->task_description?$task->task_description:$data['input']['task_description'];
}
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
                <h3 class="panel-title bariol-thin">{!! !empty(@$task->task_id) ? '<i class="fa fa-pencil"></i> '.trans('tasks.task_edit') : '<i class="fa fa-users"></i> '.trans('tasks.task_create') !!} <?php echo trans('tasks.task_name') ?></h3>
            </div>

            <div class="panel-body">
                <div class="row">

                    <!--FORM TASK-->
                    <div class="col-md-12 col-xs-12">

                        {{-- group base form --}}

                        {!! Form::open(['route'=>['tasks.edit'],  'files'=>true, 'method' => 'post'])  !!}


                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#home">{!! trans('re.overview') !!}</a></li>
                            <li><a data-toggle="tab" href="#menu1">{!! trans('re.attributes') !!}</a></li>
                            <li><a data-toggle="tab" href="#menu2">{!! trans('re.images') !!}</a></li>
                        </ul>

                        <div class="tab-content">

                            <!--TASK OVERVIEW-->
                            <div id="home" class="tab-pane fade in active">
                                @include('laravel-authentication-acl::admin.tasks.form-task-overview')
                            </div>

                            <!--TASK ATTRIBUTES-->
                            <div id="menu1" class="tab-pane fade">
                                @include('laravel-authentication-acl::admin.tasks.form-task-attributes')
                            </div>

                            <!--TASK IMAGES--->
                            <div id="menu2" class="tab-pane fade">
                                @include('laravel-authentication-acl::admin.tasks.form-task-images')
                            </div>
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