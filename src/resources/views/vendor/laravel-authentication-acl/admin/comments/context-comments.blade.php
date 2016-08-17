@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
<?php echo trans('categories.category_edit_page_title') ?>
@stop

@section('content')

<?php $comments = @$data['comments']; ?>


<div class="row">
    <div class="col-md-12">
        {{-- model general errors from the form --}}
        @if(@$data['errors'] )
            <div class="alert alert-danger">{!! trans('categories.category_unsuccessful') !!}</div>
        @elseif (@$data['message'])
            <div class="alert alert-success">{!! trans('categories.category_successful') !!}</div>
        @endif

        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title bariol-thin"><i class="fa fa-pencil"></i> '.trans('categories.category_edit') </h3>
            </div>

            <div class="panel-body">
                <div class="row">

                    <!--FORM CATEGORY-->
                    <div class="col-md-12 col-xs-12">
                        @foreach($comments as $comment)
                            @if(is_null($comment->comment_id_parent))
                                <div class='comment-item'>

                                    <div class="parent-comment-item">
                                        {!! $comment->comment_description !!}
                                    </div>
                                    @foreach($comments as $sub_comment)

                                        @if(!is_null($sub_comment->comment_id_parent))
                                            @if ($sub_comment->comment_id_parent == $comment->comment_id)
                                                <div class="child-comment-item">
                                                   >> {!! $sub_comment->comment_description !!}
                                                </div>
                                            @endif
                                        @endif

                                    @endforeach
                                </div>
                            @endif
                        @endforeach
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
        return confirm("<?php echo trans('categories.category_delete_confirm') ?>");
    });
</script>
@stop