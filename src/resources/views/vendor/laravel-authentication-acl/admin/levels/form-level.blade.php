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

                    <!--FORM TASK-->
                    <div class="col-md-12 col-xs-12">

                        {{-- group base form --}}

                        {!! Form::model($level, [ 'url' => [URL::route('levels.edit'), @$level->level_id], 'method' => 'post'] ) !!}


                        <!-- TASK TITLE -->
                        <div class="form-group">
                            {!! Form::label('level_title', trans('levels.level_title').':') !!}
                            {!! Form::text('level_title', @$level->level_title, ['class' => 'form-control', 
                            'placeholder' => trans('levels.level_title').'']) !!}
                            <span class="text-danger">{!! $errors->first('level_title') !!}</span>
                        </div>
                        

                        <!-- TASK ID HIDDEN -->
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