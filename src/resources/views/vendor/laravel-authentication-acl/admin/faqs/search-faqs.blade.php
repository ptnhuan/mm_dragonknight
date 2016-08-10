<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('faqs.faq_page_search') ?></h3>
    </div>
    <div class="panel-body">
        
        {!! Form::open(['route' => 'faqs.list','method' => 'get']) !!}
        <!-- NAME TEXT FIELD -->
        <div class="form-group">
            {!! Form::label('faq_search_title', trans('faqs.faq_search_title').'') !!}
            {!! Form::text('faq_search_title', @$faq->faq_search_title, ['class' => 'form-control', 'placeholder' => trans('faqs.faq_title').'']) !!}
        </div>
        
        <span class="text-danger">{!! $errors->first('name') !!}</span>
        {!! Form::submit(trans('faqs.faq_search').'', ["class" => "btn btn-info pull-right"]) !!}
        {!! Form::close() !!}
    </div>
</div>