<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('statuses.status_page_search') ?></h3>
    </div>
    <div class="panel-body">
        {!! Form::open(['route' => 'statuses.list','method' => 'get']) !!}
        <!-- name text field -->
        <div class="form-group">
            {!! Form::label('status_title',trans('statuses.status_title').':') !!}
            {!! Form::text('status_title', null, ['class' => 'form-control', 'placeholder' => trans('statuses.status_search_title').'']) !!}
        </div>
        <span class="text-danger">{!! $errors->first('name') !!}</span>
        {!! Form::submit(trans('statuses.status_search').'', ["class" => "btn btn-info pull-right"]) !!}
        {!! Form::close() !!}
    </div>
</div>