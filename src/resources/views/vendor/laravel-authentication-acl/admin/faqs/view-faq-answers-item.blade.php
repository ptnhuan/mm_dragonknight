<div class="faq-item">
    <div class="faq-question">
        <h4>{!! $faq->faq_title !!}</h4>
        <p>
            {!! $faq->faq_description !!}
        </p>
    </div>
    @if (!empty($faq_answers))
    <div class="faq-answers">

        @foreach($faq_answers as $item)
        <div class="faq-answer-item">
            <p class="faq-item-content">
                {!!  $item->faq_description !!}
            </p>
            <div class="faq-meta-info">

                <!--LIKES-->
                    {!! $item->faq_likes !!}

                <!--REPORTS-->
                    {!! $item->faq_reports !!}

                <!--UPDATED-->
                    {!! date('d-m-Y', $item->faq_updated_at) !!}

            </div>
            <div class="faq-action">
                <a href="#" class="like-item">
                    {!! Form::hidden('faq_likes_values',$item->faq_likes) !!}
                    {!! Form::hidden('item_id',$item->faq_id) !!}
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
                    _token: "{!! csrf_token() !!}",
                    context_id: {!! $data['context_id'] !!},
                    item_id: {!! $faq->faq_id !!},
                    url: "{!! URL::route('faqs.view', ['id' => $faq->faq_id]) !!}",
                    user_id: "{!! $data['current_user']->id !!}",
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