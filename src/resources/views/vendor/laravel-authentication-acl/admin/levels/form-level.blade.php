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

                        {!! Form::open(['route'=>['levels.edit'],  'files'=>true, 'method' => 'post'])  !!}


                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#home">{!! trans('levels.re.overview') !!}</a></li>
                            <li><a data-toggle="tab" href="#menu1">{!! trans('levels.re.attributes') !!}</a></li>
                            <li><a data-toggle="tab" href="#menu2">{!! trans('levels.re.images') !!}</a></li>
                        </ul>

                        <div class="tab-content">

                            <!--LEVEL OVERVIEW-->
                            <div id="home" class="tab-pane fade in active">
                                @include('laravel-authentication-acl::admin.levels.form-level-overview')
                            </div>

                            <!--LEVEL ATTRIBUTES-->
                            <div id="menu1" class="tab-pane fade">
                                @include('laravel-authentication-acl::admin.levels.form-level-attributes')
                            </div>

                            <!--LEVEL IMAGES--->
                            <div id="menu2" class="tab-pane fade">
                                @include('laravel-authentication-acl::admin.levels.form-level-images')
                            </div>
                        </div>

                        <!-- LEVEL ID HIDDEN -->
                        {!! Form::hidden('id',@$level->level_id) !!}
                        <a href="{!! URL::route('levels.delete',['id' => @$level->level_id, '_token' => csrf_token()]) !!}" class="btn btn-danger pull-right margin-left-5 delete"><?php echo trans('levels.level_delete') ?></a>
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