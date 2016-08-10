<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('categories.categories_search'); ?></h3>
    </div>
    <div class="panel-body">
        {!! Form::open(['route' => 'groups.list','method' => 'get']) !!}
        <!-- name text field -->
        <div class="form-group">
            {!! Form::label('categories_search_title',trans('categories.categories_search_title').'') !!}
            {!! Form::text('categories_search_title', @$categories->categories_search_title, ['class' => 'form-control', 'placeholder' => trans('categories.categories_search_title').'']) !!}
        </div>
        <span class="text-danger">{!! $errors->first('name') !!}</span>
        {!! Form::submit(trans('categories.categories_search').'', ["class" => "btn btn-info pull-right"]) !!}
        {!! Form::close() !!}
    </div>
</div>