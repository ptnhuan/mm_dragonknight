@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
<?php echo trans('categories.category_edit_page_title') ?>
@stop

@section('content')

<?php $category = @$data['category']; ?>

<div class="row">
    <div class="col-md-12">
        {{-- model general errors from the form --}}
        @if($errors->has('model') )
        <div class="alert alert-danger">{!! $errors->first('model') !!}</div>
        @endif

        {{-- successful message --}}
        <?php $message = Session::get('message'); ?>
        @if( isset($message) )
        <div class="alert alert-success">{{$message}}</div>
        @endif

        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title bariol-thin">{!! !empty(@$category->category_id) ? '<i class="fa fa-pencil"></i> '.trans('categories.category_edit') : '<i class="fa fa-users"></i> '.trans('categories.category_create') !!} <?php echo trans('categories.category_name') ?></h3>
            </div>

            <div class="panel-body">
                <div class="row">

                    <!--FORM TASK-->
                    <div class="col-md-12 col-xs-12">

                        {{-- group base form --}}

                        {!! Form::open(['route'=>['categories.edit'],  'files'=>true, 'method' => 'post'])  !!}


                        <!--  TITLE -->
                        <div class="form-group">
                            {!! Form::label('category_title', trans('categories.category_title').':') !!}
                            {!! Form::text('category_title', @$category->category_title, ['class' => 'form-control', 'placeholder' => trans('categories.category_title').'']) !!}
                            <span class="text-danger">{!! $errors->first('category_title') !!}</span>
                        </div>

                        <!--  TITLE -->
                        <div class="form-group">
                            {!! Form::label('category_id_parent', trans('categories.category_parent').':') !!}
                            {!! Form::select('category_id_parent', @$data['categories'], @$category->category_id_parent, ['class' => 'form-control']) !!}

                            <span class="text-danger">{!! $errors->first('category_title') !!}</span>
                        </div>


                        <!--  OVERVIEW -->
                        <div class="form-group">
                            {!! Form::label('category_overview', trans('categories.category_overview').':') !!}
                            {!! Form::text('category_overview', @$category->category_overview, ['class' => 'form-control', 'placeholder' => trans('categories.category_overview').'']) !!}
                            <span class="text-danger">{!! $errors->first('category_overview') !!}</span>
                        </div>

                        <!--  DESCRIPTION   -->
                        <div class="form-group">
                            {!! Form::label('category_description', trans('categories.category_description').':') !!}
                            {!! Form::text('category_description', @$category->category_description, ['class' => 'form-control', 'placeholder' => trans('categories.category_description').'']) !!}
                            <span class="text-danger">{!! $errors->first('category_description') !!}</span>
                        </div>


                        <!--  IMAGE -->
                        <div class="form-group config-images">
                            {!! Form::label('image',trans('re.images'),': *') !!}
                            {!! Form::file('image') !!}
                        </div>

                        <!--  ID HIDDEN -->
                        {!! Form::hidden('id',@$category->category_id) !!}
                        <a href="{!! URL::route('categories.delete',['id' => @$category->category_id, '_token' => csrf_token()]) !!}" class="btn btn-danger pull-right margin-left-5 delete"><?php echo trans('categories.category_delete') ?></a>
                        {!! Form::submit(trans('categories.category_save').'', array("class"=>"btn btn-info pull-right ")) !!}
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@stop

@section('footer_scripts')
<script>
    $(".delete").click(function () {
        return confirm("<?php echo trans('categories.category_delete_confirm') ?>");
    });
</script>
@stop