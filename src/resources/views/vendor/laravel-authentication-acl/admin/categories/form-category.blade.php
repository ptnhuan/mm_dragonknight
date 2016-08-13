@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
<?php echo trans('categories.category_edit_page_title') ?>
@stop

@section('content')
<?php
$category = @$data['category'];
$category_images = @$data['category'];
 
if (@$data['input']) {
    $category = new stdClass();
    $category->category_title = @$category->category_title?$category->category_title:$data['input']['category_title'];
    $category->category_overview = @$category->category_overview?$category->category_overview:$data['input']['category_overview'];
    $category->category_description = @$category->category_description?$category->category_description:$data['input']['category_description'];
}
?>

<?php
$arr_images = array();

if (!empty($category_images)) {
    $arr = $category_images->category_images;
    $arr_images = json_decode($category_images->category_images);
}
?>


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
                <h3 class="panel-title bariol-thin">{!! !empty(@$category->category_id) ? '<i class="fa fa-pencil"></i> '.trans('categories.category_edit') : '<i class="fa fa-users"></i> '.trans('categories.category_create') !!} <?php echo trans('categories.category_name') ?></h3>
            </div>

            <div class="panel-body">
                <div class="row">

                    <!--FORM CATEGORY-->
                    <div class="col-md-12 col-xs-12">

                        {{-- group base form --}}

                        {!! Form::open(['route'=>['categories.edit'],  'files'=>true, 'method' => 'post'])  !!}


                        <!--  TITLE -->
                        <div class="form-group">
                            {!! Form::label('category_title', trans('categories.category_title').':') !!}
                            {!! Form::text('category_title', @$category->category_title, ['class' => 'form-control', 'placeholder' => trans('categories.category_title').'']) !!}
                            <span class="text-danger">{!! $errors->first('category_title') !!}</span>
                        </div>

                        <!--  TITLE -->
                        <div class="form-group">
                            {!! Form::label('category_id_parent', trans('categories.category_parent').':') !!}
                            {!! Form::select('category_id_parent', @$data['categories'], @$category->category_id_parent, ['class' => 'form-control']) !!}

                            <span class="text-danger">{!! $errors->first('category_title') !!}</span>
                        </div>


                        <!--  OVERVIEW -->
                        <div class="form-group">
                            {!! Form::label('category_overview', trans('categories.category_overview').':') !!}
                            {!! Form::text('category_overview', @$category->category_overview, ['class' => 'form-control', 'placeholder' => trans('categories.category_overview').'']) !!}
                            <span class="text-danger">{!! $errors->first('category_overview') !!}</span>
                        </div>

                        <!--  DESCRIPTION   -->
                        <div class="form-group">
                            {!! Form::label('category_description', trans('categories.category_description').':') !!}
                            {!! Form::text('category_description', @$category->category_description, ['class' => 'form-control', 'placeholder' => trans('categories.category_description').'']) !!}
                            <span class="text-danger">{!! $errors->first('category_description') !!}</span>
                        </div>


                        <!--  IMAGE -->
                        <div class="form-group config-images">
                            {!! Form::label('image',trans('re.images'),': *') !!}
                            {!! Form::file('image') !!}
                            {!! Form::hidden('is_file', !empty(@$category->category_image)?1:0, ['class' => 'is_file']) !!}

                            {!! Form::radio('set_to', 1, true) !!} Main
                            {!! Form::radio('set_to', 0, false) !!} Move to other

                        </div>

                        @if(@$category->category_image)
                        <div class="img-thumb">
                            <img src="{!! url($data['configs']['category']['urlpath'].'/'.$category->category_image) !!}">
                        </div>


                        <div class="showfile">
                            <i class=" fa fa-file-excel-o" aria-hidden="true"></i>
                            <span class="filename">{!! $category->category_image !!}</span>
                            <div class="clearfix"></div>

                            <div class="control-file">
                                <span class="del">Delete</span>
                                <span class="undo" style="display: none">Undo</span>
                            </div>
                        </div>
                        @endif

                        @if($arr_images)
                        <table class="table table-hover images-table">
                            <thead>
                                <tr>
                                    <th style="width: 5%">STT</th>
                                    <th style="width: 25%">Hình</th>
                                    <th style="width: 50%">Mô tả</th>
                                    <th style="width: 205%">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $counter = 1; ?>
                                @foreach($arr_images as $index=> $item)
                                <tr class="item_image">
                                    <td><?php
                                        echo $counter;
                                        $counter++;
                                        ?></td>
                                    <td>
                                        <div class="img-thumb">
                                            <img src="{!! url($data['configs']['category']['urlpath'].'/'.$item->name) !!}">
                                            <input type='hidden' name='images_name[]' value="<?php echo $item->name ?>" >
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            {!! Form::textarea('images_info[]',$item->info, ['class' => 'form-control view-write', 'placeholder' => trans('re.description'), 'rows' => 7, 'cols' => 40]) !!}
                                            <div class='view-read'>
                                                {!! $item->info !!}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span href="#" title='view' class='view'><i class="fa fa-eye fa-2x"></i></span>
                                        <span href="#" title='edit' class="edit margin-left-5"><i class="fa fa-pencil-square-o fa-2x"></i></span>
                                        <span href="#" title='delete' class="margin-left-5"><i class="fa fa-trash-o delete fa-2x"></i></span>
                                        <span href="#" title='down' class='down'><i class="fa fa-sort-desc fa-2x" aria-hidden="true"></i></span>
                                        <span href="#" title='up' class='up'><i class="fa fa-sort-asc fa-2x" aria-hidden="true"></i></span>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif

                        @section('footer_more_scripts')
                        <script>
                            $(".delete").click(function () {
                                if (confirm('{!!trans('front.alert_you_want_delete_payroll')!!}')) {
                                    $(this).parents('.item_image').remove();
                                }
                            });

                            var _is_file = $('.is_file').val();
                            $('.showfile .del').click(function () {
                                $('.showfile .fa').removeClass('fa-file-excel-o');
                                $('.showfile .fa').addClass('fa-file-image-o');
                                $('.showfile .fa').css({'color': '#f0ad4e'});
                                $('.showfile .undo').show();
                                $('.showfile .filename').hide();
                                $('.is_file').val(0);
                                $(this).hide();
                            });

                            $('.showfile .undo').click(function () {
                                $('.showfile .fa').removeClass('fa-file-image-o');
                                $('.showfile .fa').addClass('fa-file-excel-o');
                                $('.showfile .fa').css({'color': '#1fa67a'});
                                $(this).hide();
                                $('.is_file').val(_is_file);
                                $('.showfile .filename').show();
                                $('.showfile .del').show();
                            });

                            $(".down").click(function () {
                                var $parent = $(this).parents(".item_image");
                                $parent.insertAfter($parent.next());
                            });

                            $(".up").click(function () {
                                var $parent = $(this).parents(".item_image");
                                $parent.insertBefore($parent.prev());
                            });

                            $(".edit").click(function () {

                                $(this).parents('.item_image').find('.view-read').hide();
                                $(this).parents('.item_image').find('.view-write').show();

                            });
                            $(".view").click(function () {

                                $(this).parents('.item_image').find('.view-read').show();
                                $(this).parents('.item_image').find('.view-write').hide();

                            });

                        </script>
                        @stop


                        <!--  ID HIDDEN -->
                        {!! Form::hidden('id',@$category->category_id) !!}
                        <a href="{!! URL::route('categories.delete',['id' => @$category->category_id, '_token' => csrf_token()]) !!}" class="btn btn-danger pull-right margin-left-5 delete"><?php echo trans('categories.category_delete') ?></a>
                        {!! Form::submit(trans('categories.category_save').'', array("class"=>"btn btn-info pull-right ")) !!}
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
        return confirm("<?php echo trans('categories.category_delete_confirm') ?>");
    });
</script>
@stop