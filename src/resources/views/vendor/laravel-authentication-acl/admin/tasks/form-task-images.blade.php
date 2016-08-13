<?php
$arr_images = array();

if (!empty($task_images)) {
    $arr = $task_images->task_images;
    $arr_images = json_decode($task_images->task_images);
}
?>
<!-- TASK IMAGE -->
<div class="form-group config-images">
    {!! Form::label('image',trans('tasks.task_images'),': *') !!}
    {!! Form::file('image') !!}
    {!! Form::hidden('is_file', !empty(@$task->task_image)?1:0, ['class' => 'is_file']) !!}

        {!! Form::radio('set_to', 1, true) !!} Main
        {!! Form::radio('set_to', 0, false) !!} Move to other
</div>


@if(@$task->task_image)
<div class="img-thumb">
    <img src="{!! url($data['configs']['task']['urlpath'].'/'.$task->task_image) !!}">
</div>


<div class="showfile">
    <i class=" fa fa-file-excel-o" aria-hidden="true"></i>
    <span class="filename">{!! $task->task_image !!}</span>
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
                    <img src="{!! url($data['configs']['task']['urlpath'].'/'.$item->name) !!}">
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