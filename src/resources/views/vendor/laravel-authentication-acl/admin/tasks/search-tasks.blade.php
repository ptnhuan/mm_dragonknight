<?php $request = @$data['request']; ?>

<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('tasks.task_page_search') ?></h3>
    </div>
    <div class="panel-body">

        {!! Form::open(['route' => 'tasks.list','method' => 'get']) !!}

        <!--TITLE-->
        <div class="form-group">
            {!! Form::label('task_title', trans('tasks.task_search_title').'') !!}
            {!! Form::text('task_title', @$request->get('task_title'), ['class' => 'form-control', 'placeholder' => trans('tasks.task_title').'']) !!}
            <span class="text-danger">{!! $errors->first('task_title') !!}</span>
        </div>

        <!-- TASK STATUS -->
        <div class="form-group">
            {!! Form::label('status_id', trans('tasks.task_status').':') !!}
            {!! Form::select('status_id', @$data['statuses'], @$request->get('status_id'), ['class' => 'form-control']) !!}

            <span class="text-danger">{!! $errors->first('status_id') !!}</span>
        </div>

        {!! Form::submit(trans('tasks.task_search').'', ["class" => "btn btn-info pull-right"]) !!}
        {!! Form::close() !!}
    </div>
</div>