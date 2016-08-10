<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('tasks.task_page_search') ?></h3>
    </div>
    <div class="panel-body">
        
        {!! Form::open(['route' => 'tasks.list','method' => 'get']) !!}
        <!-- NAME TEXT FIELD -->
        <div class="form-group">
            {!! Form::label('task_search_title', trans('tasks.task_search_title').'') !!}
            {!! Form::text('task_search_title', @$task->task_search_title, ['class' => 'form-control', 'placeholder' => trans('tasks.task_title').'']) !!}
        </div>
        
        <span class="text-danger">{!! $errors->first('name') !!}</span>
        {!! Form::submit(trans('tasks.task_search').'', ["class" => "btn btn-info pull-right"]) !!}
        {!! Form::close() !!}
    </div>
</div>