@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
<?php echo trans('levels.level_list_page_title') ?>
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
                        {!! $data['request']->all() ? trans('levels.level_page_search') : trans('levels.level_page') !!}:
                    </h3>
                </div>
                <div class="panel-body">
                    @include('laravel-authentication-acl::admin.levels.list-levels-item')
               </div>
           </div>
        </div>
        <div class="col-md-4">
            @include('laravel-authentication-acl::admin.levels.search-levels')
        </div>
    </div>
</div>
@stop

@section('footer_scripts')
    <script>
        $(".delete").click(function(){
            return confirm("<?php echo trans('levels.level_delete_confirm') ?>");
        });
    </script>
@stop