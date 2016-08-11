<?php $request = @$data['request']; ?>

<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('faqs.faq_page_search') ?></h3>
    </div>
    <div class="panel-body">

        {!! Form::open(['route' => 'faqs.list','method' => 'get']) !!}

        <!--TITLE-->
        <div class="form-group">
            {!! Form::label('faq_title', trans('faqs.faq_search_title').'') !!}
            {!! Form::text('faq_title', @$request->get('faq_title'), ['class' => 'form-control', 'placeholder' => trans('faqs.faq_title').'']) !!}
            <span class="text-danger">{!! $errors->first('faq_title') !!}</span>
        </div>

        <!-- TASK STATUS -->
        <div class="form-group">
            {!! Form::label('status_id', trans('faqs.faq_status').':') !!}
            {!! Form::select('status_id', @$data['statuses'], @$request->get('status_id'), ['class' => 'form-control']) !!}

            <span class="text-danger">{!! $errors->first('status_id') !!}</span>
        </div>

        {!! Form::submit(trans('faqs.faq_search').'', ["class" => "btn btn-info pull-right"]) !!}
        {!! Form::close() !!}
    </div>  
</div>