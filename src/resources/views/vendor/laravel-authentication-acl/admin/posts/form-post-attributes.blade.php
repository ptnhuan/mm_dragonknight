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

<!-- POST LEVEL -->
<div class="form-group">
    {!! Form::label('level_id', trans('posts.post_level').':') !!}
    {!! Form::select('level_id', @$data['levels'], @$post->level_id, ['class' => 'form-control']) !!}

    <span class="text-danger">{!! $errors->first('level_id') !!}</span>
</div>

<!-- POST USER POST -->
<div class="form-group">
    {!! Form::label('user_id', trans('posts.post_user_post').':') !!}
    {!! Form::select('user_id', @$data['current_user'], @$post->user_id, ['class' => 'form-control']) !!}

    <span class="text-danger">{!! $errors->first('user_id') !!}</span>
</div>
