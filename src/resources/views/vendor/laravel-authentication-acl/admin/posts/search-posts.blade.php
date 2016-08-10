<?php $request = @$data['request']; ?>

<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('posts.post_page_search') ?></h3>
    </div>
    <div class="panel-body">

        {!! Form::open(['route' => 'posts.list','method' => 'get']) !!}

        <!--TITLE-->
        <div class="form-group">
            {!! Form::label('post_title', trans('posts.post_search_title').'') !!}
            {!! Form::text('post_title', @$request->get('post_title'), ['class' => 'form-control', 'placeholder' => trans('posts.post_title').'']) !!}
            <span class="text-danger">{!! $errors->first('post_title') !!}</span>
        </div>

        <!-- TASK STATUS -->
        <div class="form-group">
            {!! Form::label('status_id', trans('posts.post_status').':') !!}
            {!! Form::select('status_id', @$data['statuses'], @$request->get('status_id'), ['class' => 'form-control']) !!}

            <span class="text-danger">{!! $errors->first('status_id') !!}</span>
        </div>

        {!! Form::submit(trans('posts.post_search').'', ["class" => "btn btn-info pull-right"]) !!}
        {!! Form::close() !!}
    </div>
</div>