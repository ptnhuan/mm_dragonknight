
<!-- TASK STATUS -->
<div class="form-group">
    {!! Form::label('status_id', trans('tasks.task_status').':') !!}
    {!! Form::select('status_id', @$data['statuses'], @$user_task->user_task_status, ['class' => 'form-control']) !!}

    <span class="text-danger">{!! $errors->first('status_id') !!}</span>
</div>
