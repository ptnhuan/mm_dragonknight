@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
Admin area: edit group
@stop

@section('content')

<?php
$level = @$data['level'];
?>

<div class="row">
    <div class="col-md-12">
        <div class="col-sm-12">
            <?php $message = Session::get('message'); ?>

            @if( isset($message) )
            <div class="alert alert-success">{{$message}}</div>
            @endif

            <div class="panel panel-info">

                <div class="panel-heading">
                    <h3 class="panel-title bariol-thin">
                        {!! isset($status->status_id) ? '<i class="fa fa-pencil"></i> '.trans("positions.edit") : '<i class="fa fa-plus"></i> '.trans("positions.add") !!}
                    </h3>
                </div>

                <div class="panel-body">
                    {!! Form::open(['route'=>['statuses.edit'],'method' => 'post'])  !!}

                    <!-- title text field -->
                    <div class="form-group">

                        {!! Form::label('title',trans('positions.title'),': *') !!}
                        {!! Form::text('title',  $status->status_title, ['class' => 'form-control', 'placeholder' =>trans('positions.title')]) !!}

                        <span class="text-danger">{!! $errors->first('title') !!}</span>

                    </div>


                    {!! Form::hidden('id', $status->status_id) !!}
                    @if($status->status_title != null)

                    <a href="{!! URL::route('statuses.delete',['id' => $status->status_title, '_token' => csrf_token()]) !!}" class="btn btn-danger pull-right margin-left-5 delete">
                        {!!trans('positions.delete')!!}
                    </a>

                    @else

                    <a href="{!! URL::route('statuses.list') !!}" class="btn btn-danger pull-right margin-left-5">
                        {!!trans('positions.cancel')!!}
                    </a>

                    @endif

                    {!! Form::submit(trans('positions.save'), array("class"=>"btn btn-info pull-right ")) !!}

                    {!! Form::close() !!}
                </div>

            </div>
        </div>

    </div>

</div>
@stop

@section('footer_scripts')
<script>
    $(".delete").click(function () {
        return confirm("Are you sure to delete this item?");
    });
</script>
@stop