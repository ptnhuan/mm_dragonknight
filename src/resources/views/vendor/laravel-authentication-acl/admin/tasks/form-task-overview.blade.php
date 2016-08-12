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