@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
<?php echo trans('faqs.faq_edit_page_title') ?>
@stop

@section('content')



<?php
$faq = @$data['faq'];
$faq_image = @$data['faq'];
if (@$data['input']) {
    $faq = new stdClass();  
    $faq->faq_title = @$faq->faq_title?$faq->faq_title:$data['input']['faq_title'];
    $faq->faq_overview = @$faq->faq_overview?$faq->faq_overview:$data['input']['faq_overview'];
    $faq->faq_description = @$faq->faq_description?$faq->faq_description:$data['input']['faq_description'];
}
?>

<div class="row">
    <div class="col-md-12">
        {{-- model general errors from the form --}}

        @if(@$data['errors'] )
            <div class="alert alert-danger">{!! trans('faqs.faq_unsuccessful') !!}</div>
        @elseif (@$data['message'])
            <div class="alert alert-success">{!! trans('faqs.faq_successful') !!}</div>
        @endif



        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title bariol-thin">{!! !empty(@$faq->faq_id) ? '<i class="fa fa-pencil"></i> '.trans('faqs.faq_edit') : '<i class="fa fa-users"></i> '.trans('faqs.faq_create') !!} <?php echo trans('faqs.faq_name') ?></h3>
            </div>

            <div class="panel-body">
                <div class="row">

                    <!--FORM TASK-->
                    <div class="col-md-12 col-xs-12">

                        {{-- group base form --}}

                        {!! Form::open(['route'=>['faqs.edit'],  'files'=>true, 'method' => 'faq'])  !!}


                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#home">{!! trans('faqs.faq_tab_overview') !!}</a></li>
                            <li><a data-toggle="tab" href="#menu1">{!! trans('faqs.faq_tab_attributes') !!}</a></li>
                            <li><a data-toggle="tab" href="#menu2">{!! trans('faqs.faq_tab_image') !!}</a></li>
                        </ul>

                        <div class="tab-content">

                            <!--TASK OVERVIEW-->
                            <div id="home" class="tab-pane fade in active">
                                @include('laravel-authentication-acl::admin.faqs.form-faq-overview')
                            </div>

                            <!--TASK ATTRIBUTES-->
                            <div id="menu1" class="tab-pane fade">
                                @include('laravel-authentication-acl::admin.faqs.form-faq-attributes')
                            </div>

                            <!--TASK IMAGES--->
                            <div id="menu2" class="tab-pane fade">
                                @include('laravel-authentication-acl::admin.faqs.form-faq-image')
                            </div>

                           
                        </div>

                        <!-- TASK ID HIDDEN -->
                        {!! Form::hidden('id',@$faq->faq_id) !!}
                        <a href="{!! URL::route('faqs.delete',['id' => @$faq->faq_id, '_token' => csrf_token()]) !!}" class="btn btn-danger pull-right margin-left-5 delete"><?php echo trans('faqs.faq_delete') ?></a>
                        {!! Form::submit(trans('faqs.faq_save').'', array("class"=>"btn btn-info pull-right ")) !!}
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
        return confirm("<?php echo trans('faqs.faq_delete_confirm') ?>");
    });
</script>
@stop