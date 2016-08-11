@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
<?php echo trans('posts.post_edit_page_title') ?>
@stop

@section('content')

<?php 
$post = @$data['post']; 
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
                <h3 class="panel-title bariol-thin">
                    {!! !empty(@$post->post_id) ? '<i class="fa fa-pencil"></i> '.trans('posts.post_edit') : '<i class="fa fa-users"></i> '.trans('posts.post_create') !!}
                     <?php echo trans('posts.post_name') ?>
                </h3>
            </div>

            <div class="panel-body">
                <div class="row">

                    <!--FORM TASK-->
                    <div class="col-md-12 col-xs-12">

                        {{-- group base form --}}

                        {!! Form::model($post, [ 'url' => [URL::route('posts.edit'), @$post->post_id], 'method' => 'post'] ) !!}


                        <!-- TASK TITLE -->
                        <div class="form-group">
                            {!! Form::label('post_title', trans('posts.post_title').':') !!}
                            {!! Form::text('post_title', @$post->post_title, ['class' => 'form-control', 'placeholder' => trans('posts.post_title').'']) !!}
                            <span class="text-danger">{!! $errors->first('post_title') !!}</span>
                        </div>
                         
                        <!-- TASK OVERVIEW -->
                        <div class="form-group">
                            {!! Form::label('post_overview', trans('posts.post_overview').':') !!}
                            {!! Form::text('post_overview', @$post->post_overview, ['class' => 'form-control', 'placeholder' => trans('posts.post_overview').'']) !!}
                            <span class="text-danger">{!! $errors->first('post_overview') !!}</span>
                        </div>
                        
                        <!-- TASK DESCRIPTION   -->
                        <div class="form-group">
                            {!! Form::label('post_description', trans('posts.post_description').':') !!}
                            {!! Form::text('post_description', @$post->post_description, ['class' => 'form-control', 'placeholder' => trans('posts.post_description').'']) !!}
                            <span class="text-danger">{!! $errors->first('post_description') !!}</span>
                        </div>
                        
                         <!-- TASK NOTES   -->
                        <div class="form-group">
                            {!! Form::label('post_notes', trans('posts.post_notes').':') !!}
                            {!! Form::text('post_notes', @$post->post_notes, ['class' => 'form-control', 'placeholder' => trans('posts.post_notes').'']) !!}
                            <span class="text-danger">{!! $errors->first('post_notes') !!}</span>
                        </div>
                        
                        <!-- TASK STATUS -->
                        <div class="form-group">
                            {!! Form::label('status_id', trans('posts.post_status').':') !!}
                            {!! Form::select('status_id', @$data['statuses'], @$post->status_id, ['class' => 'form-control']) !!}

                            <span class="text-danger">{!! $errors->first('status_id') !!}</span>
                        </div>

                        <!-- TASK ID HIDDEN -->
                        {!! Form::hidden('id',@$post->post_id) !!}
                        <a href="{!! URL::route('posts.delete',['id' => @$post->post_id, '_token' => csrf_token()]) !!}" class="btn btn-danger pull-right margin-left-5 delete"><?php echo trans('posts.post_delete') ?></a>
                        {!! Form::submit(trans('posts.post_save').'', array("class"=>"btn btn-info pull-right ")) !!}
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
        return confirm("<?php  echo trans('posts.post_delete_confirm')?>");
    });
</script>
@stop