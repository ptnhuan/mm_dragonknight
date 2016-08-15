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
    {!! Form::label('task_points', trans('tasks.task_points').':') !!}
    {!! Form::text('task_points', @$task->task_points, ['class' => 'form-control', 'placeholder' => trans('tasks.task_points').'']) !!}
    <span class="text-danger">{!! $errors->first('task_points') !!}</span>
</div>



