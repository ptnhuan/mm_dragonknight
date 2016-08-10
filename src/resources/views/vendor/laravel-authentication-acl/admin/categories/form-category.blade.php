@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
<?php echo trans('categories.category_edit_page_title') ?>
@stop

@section('content')

<?php
$category = @$data['category'];
?>

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

                        {!! Form::model($category, [ 'url' => [URL::route('categories.edit'), @$category->category_id], 'method' => 'post'] ) !!}


                        <!-- TASK TITLE -->
                        <div class="form-group">
                            {!! Form::label('category_title', trans('categories.category_title').':') !!}
                            {!! Form::text('category_title', @$category->category_title, ['class' => 'form-control', 'placeholder' => trans('categories.category_title').'']) !!}
                            <span class="text-danger">{!! $errors->first('category_title') !!}</span>
                        </div>
                      

                        <!-- TASK ID HIDDEN -->
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
        return confirm("<?php  echo trans('categories.category_delete_confirm')?>");
    });
</script>
@stop