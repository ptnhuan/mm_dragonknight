@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
<?php echo trans('users_tasks.users_task_list_page_title') ?>
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="col-md-8">
            {{-- print messages --}}
            <?php $message = Session::get('message'); ?>
            @if( isset($message) )
            <div class="alert alert-success">{!! $message !!}</div>
            @endif
            {{-- print errors --}}
            @if($errors && ! $errors->isEmpty() )
            @foreach($errors->all() as $error)
            <div class="alert alert-danger">{!! $error !!}</div>
            @endforeach
            @endif
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title bariol-thin">
                        <i class="fa fa-group"></i>
                        {!! $data['request']->all() ? trans('users_tasks.users_task_page_search') : trans('users_tasks.users_task_page') !!}:
                    </h3>
                </div>
                <div class="panel-body">
                    @include('laravel-authentication-acl::user.user_tasks.list-user-tasks-item')
                </div>
            </div>
        </div>
        <div class="col-md-4">
            @include('laravel-authentication-acl::user.user_tasks.search-user-tasks')
        </div>
    </div>
</div>
@stop

@section('footer_scripts')
<script>
    $(".delete").click(function () {
        return confirm("<?php echo trans('users_tasks.users_task_delete_confirm') ?>");
    });
</script>
@stop