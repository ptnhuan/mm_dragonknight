<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('categories.category_search'); ?></h3>
    </div>
    <div class="panel-body">
        {!! Form::open(['route' => 'categories.list','method' => 'get']) !!}
        <!-- name text field -->
        <div class="form-group">
            {!! Form::label('category_title',trans('categories.category_title').'') !!}
            {!! Form::text('category_title', @$categories->category_title, ['class' => 'form-control', 'placeholder' => trans('categories.category_title').'']) !!}
        </div>
        <span class="text-danger">{!! $errors->first('name') !!}</span>
        {!! Form::submit(trans('categories.category_search').'', ["class" => "btn btn-info pull-right"]) !!}
        {!! Form::close() !!}
    </div>
</div>