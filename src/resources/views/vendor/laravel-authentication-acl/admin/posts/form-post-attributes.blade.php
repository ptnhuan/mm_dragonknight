<!-- POST STATUS -->
<div class="form-group">
    {!! Form::label('status_id', trans('posts.post_status').':') !!}
    {!! Form::select('status_id', @$data['statuses'], @$post->status_id, ['class' => 'form-control']) !!}

    <span class="text-danger">{!! $errors->first('status_id') !!}</span>
</div>

<!-- POST CATEGORIES -->
<div class="form-group">
    {!! Form::label('category_id', trans('posts.post_category').':') !!}
    {!! Form::select('category_id', @$data['categories'], @$post->category_id, ['class' => 'form-control']) !!}

    <span class="text-danger">{!! $errors->first('category_id') !!}</span>
</div>
