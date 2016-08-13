<!-- POST STATUS -->
<div class="form-group">
    {!! Form::label('status_id', trans('posts.post_status').':') !!}
    {!! Form::select('status_id', @$data['statuses'], @$post->status_id, ['class' => 'form-control']) !!}

    <span class="text-danger">{!! $errors->first('status_id') !!}</span>
</div>

 



