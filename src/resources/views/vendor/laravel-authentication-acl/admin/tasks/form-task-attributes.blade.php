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

<!-- TASK POINT -->
<div class="form-group">
    {!! Form::label('task_point', trans('tasks.task_point').':') !!}
    {!! Form::text('task_point', @$task->task_point, ['class' => 'form-control', 'placeholder' => trans('tasks.task_point').'']) !!}
    <span class="text-danger">{!! $errors->first('task_point') !!}</span>
</div>



