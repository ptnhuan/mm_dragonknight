<div class="faq-item">
    <div class="faq-question">
        <h4>{!! $faq->faq_title !!}</h4>
        <p>
            {!! $faq->faq_description !!}
        </p>
    </div>
    @if (!empty($faq_answers))
    <div class="faq-answers">

        @foreach($faq_answers as $faq)
        <div class="faq-answer-item">
            <p class="faq-item-content">
                {!!  $faq->faq_description !!}
            </p>
            <div class="faq-meta-info">

                <!--LIKES-->
                    {!! $faq->faq_likes !!}

                <!--REPORTS-->
                    {!! $faq->faq_reports !!}

                <!--UPDATED-->
                    {!! date('d-m-Y', $faq->faq_updated_at) !!}

            </div>
            <div class="faq-action">
                <a href="#" class="like-item">
                    {!! Form::hidden('faq_likes_values',$faq->faq_likes) !!}
                    <i class="fa fa-thumbs-up fa-2x" aria-hidden="true"></i>
                </a>
                <a href="#"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-trash-o fa-2x"></i></a>
            </div>
        </div>
        @endforeach

    </div>
    @endif
</div>


@section('footer_ajax_scripts')
<script>
    /**
     * Search user by keyword
     */
    var timeout;
    $(".like-item").click(function () {
        if(timeout) {
            clearTimeout(timeout);
            timeout = null;
        }
        timeout  = setTimeout(function () {
            $.ajax({
                type: "POST",
                url: "{!!  URL::route('ajax_faq.like') !!}",
                data: {
                    '_token': "{!! csrf_token() !!}",
                    'type': 'faq',
                    'item_id':
                },
                success: function (data) {

                },
                error: function (data) {
                }
            });

        }, 1000);
    });//End search
</script>
@stop