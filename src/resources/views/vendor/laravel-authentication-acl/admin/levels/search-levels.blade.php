<?php $request = @$data['request']; ?>

<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin">
            <i class="fa fa-search"></i>
                <?php echo trans('levels.level_page_search') ?>
        </h3>
    </div>
    <div class="panel-body">

        {!! Form::open(['route' => 'levels.list','method' => 'get']) !!}

        <!--TITLE-->
        <div class="form-group">
            {!! Form::label('level_title', trans('levels.level_search_title').'') !!}
            {!! Form::text('level_title', @$request->get('level_title'), ['class' => 'form-control', 
            'placeholder' => trans('levels.level_title').'']) !!}
            <span class="text-danger">{!! $errors->first('level_title') !!}</span>
        </div>
        {!! Form::submit(trans('levels.level_search').'', ["class" => "btn btn-info pull-right"]) !!}
        {!! Form::close() !!}
    </div>
</div>