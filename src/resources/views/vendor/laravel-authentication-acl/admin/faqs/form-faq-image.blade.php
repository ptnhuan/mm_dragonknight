 
<!-- FAQ IMAGE -->
<div class="form-group config-images">
    {!! Form::label('image',trans('faqs.faq_images'),': *') !!}
    {!! Form::file('image') !!}
    {!! Form::hidden('is_file', !empty(@$faq->faq_image)?1:0, ['class' => 'is_file']) !!}
</div>


@if(@$faq_image->faq_image)
<div class="img-thumb">
    <img src="{!! url($data['configs']['faq']['urlpath'].'/'.$faq->faq_image) !!}">
</div>


<div class="showfile">
    <i class=" fa fa-file-excel-o" aria-hidden="true"></i>
    <span class="filename">{!! $faq->faq_image !!}</span>
    <div class="clearfix"></div>

    <div class="control-file">
        <span class="del">Delete</span>
        <span class="undo" style="display: none">Undo</span>
    </div>
</div>
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

     

</script>
@stop