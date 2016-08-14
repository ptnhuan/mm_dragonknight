@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
<?php echo trans('posts.post_edit_page_title') ?>
@stop

@section('content')



<?php
$post = @$data['post'];
$post_images = @$data['post'];
if (@$data['input']) {
    $post = new stdClass();
    $post->post_title = @$post->post_title?$post->post_title:$data['input']['post_title'];
    $post->post_overview = @$post->post_overview?$post->post_overview:$data['input']['post_overview'];
    $post->post_description = @$post->post_description?$post->post_description:$data['input']['post_description'];
}
?>

<div class="row">
    <div class="col-md-12">
        {{-- model general errors from the form --}}

        @if(@$data['errors'] )
            <div class="alert alert-danger">{!! trans('posts.post_unsuccessful') !!}</div>
        @elseif (@$data['message'])
            <div class="alert alert-success">{!! trans('posts.post_successful') !!}</div>
        @endif



        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title bariol-thin">{!! !empty(@$post->post_id) ? '<i class="fa fa-pencil"></i> '.trans('posts.post_edit') : '<i class="fa fa-users"></i> '.trans('posts.post_create') !!} <?php echo trans('posts.post_name') ?></h3>
            </div>

            <div class="panel-body">
                <div class="row">

                    <!--FORM POST-->
                    <div class="col-md-12 col-xs-12">

                        {{-- group base form --}}

                        {!! Form::open(['route'=>['posts.edit'],  'files'=>true, 'method' => 'post'])  !!}


                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#home">{!! trans('posts.post_tab_overview') !!}</a></li>
                            <li><a data-toggle="tab" href="#menu1">{!! trans('posts.post_tab_attributes') !!}</a></li>
                            <li><a data-toggle="tab" href="#menu2">{!! trans('posts.post_tab_images') !!}</a></li>
                            
                        </ul>

                        <div class="tab-content">

                            <!--POST OVERVIEW-->
                            <div id="home" class="tab-pane fade in active">
                                @include('laravel-authentication-acl::admin.posts.form-post-overview')
                            </div>

                            <!--POST ATTRIBUTES-->
                            <div id="menu1" class="tab-pane fade">
                                @include('laravel-authentication-acl::admin.posts.form-post-attributes')
                            </div>

                            <!--POST IMAGES--->
                            <div id="menu2" class="tab-pane fade">
                                @include('laravel-authentication-acl::admin.posts.form-post-images')
                            </div>

                            
                        </div>

                        <!-- POST ID HIDDEN -->
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
        return confirm("<?php echo trans('posts.post_delete_confirm') ?>");
    });
</script>
@stop