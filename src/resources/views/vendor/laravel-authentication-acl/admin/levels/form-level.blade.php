@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
<?php echo trans('levels.level_edit_page_title') ?>
@stop

@section('content')

<?php
$level = @$data['level'];
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
                    {!! !empty(@$level->level_id) ? '
                    <i class="fa fa-pencil"></i>
                    '.trans('levels.level_edit') : '
                    <i class="fa fa-users"></i> 
                    '.trans('levels.level_create') !!} <?php echo trans('levels.level_name') ?></h3>
            </div>

            <div class="panel-body">
                <div class="row">

                    <!--FORM LEVEL-->
                    <div class="col-md-12 col-xs-12">

                        {{-- group base form --}}

                        {!! Form::model($level, [ 'url' => [URL::route('levels.edit'), @$level->level_id], 'method' => 'post'] ) !!}


                        <!-- LEVEL TITLE -->
                        <div class="form-group">
                            {!! Form::label('level_title', trans('levels.level_title').':') !!}
                            {!! Form::text('level_title', @$level->level_title, ['class' => 'form-control', 
                            'placeholder' => trans('levels.level_title').'']) !!}
                            <span class="text-danger">{!! $errors->first('level_title') !!}</span>
                        </div>
                        
                         <!-- LEVEL POINT -->
                        <div class="form-group">
                            {!! Form::label('level_point', trans('levels.level_point').':') !!}
                            {!! Form::text('level_point', @$level->level_point, ['class' => 'form-control', 
                            'placeholder' => trans('levels.level_point').'']) !!}
                            <span class="text-danger">{!! $errors->first('level_point') !!}</span>
                        </div>
                         
                           <!-- LEVEL OVERVIEW -->
                        <div class="form-group">
                            {!! Form::label('level_overview', trans('levels.level_overview').':') !!}
                            {!! Form::text('level_overview', @$level->level_overview, ['class' => 'form-control', 
                            'placeholder' => trans('levels.level_overview').'']) !!}
                            <span class="text-danger">{!! $errors->first('level_overview') !!}</span>
                        </div>
                           
                             <!-- LEVEL DESCRIPTION -->
                        <div class="form-group">
                            {!! Form::label('level_description', trans('levels.level_description').':') !!}
                            {!! Form::text('level_description', @$level->level_description, ['class' => 'form-control', 
                            'placeholder' => trans('levels.level_description').'']) !!}
                            <span class="text-danger">{!! $errors->first('level_description') !!}</span>
                        </div>
                             
                             <!-- LEVEL IMAGE -->
                        <div class="form-group">
                            {!! Form::label('level_image', trans('levels.level_image').':') !!}
                            {!! Form::text('level_image', @$level->level_image, ['class' => 'form-control', 
                            'placeholder' => trans('levels.level_image').'']) !!}
                            <span class="text-danger">{!! $errors->first('level_image') !!}</span>
                        </div>
                                  
                             <!-- LEVEL IMAGES -->
                        <div class="form-group">
                            {!! Form::label('level_images', trans('levels.level_images').':') !!}
                            {!! Form::text('level_images', @$level->level_images, ['class' => 'form-control', 
                            'placeholder' => trans('levels.level_images').'']) !!}
                            <span class="text-danger">{!! $errors->first('level_images') !!}</span>
                        </div>
                                       
                        <!-- LEVEL ID HIDDEN -->
                        {!! Form::hidden('id',@$level->level_id) !!}
                        <a href="{!! URL::route('levels.delete',['id' => @$level->level_id, '_token' => csrf_token()]) !!}" class="btn btn-danger pull-right margin-left-5 delete">
                            <?php echo trans('levels.level_delete') ?>
                        </a>
                        {!! Form::submit(trans('levels.level_save').'', array("class"=>"btn btn-info pull-right ")) !!}
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
        return confirm("<?php  echo trans('levels.level_delete_confirm')?>");
    });
</script>
@stop