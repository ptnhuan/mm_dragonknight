@if (!empty($faq))
    @if (!empty($faq_answers))
        @foreach($faq_answers as $faq)
            @if(is_null($faq->faq_id_parent))
            <div class="faq-question">
                <h4>{!! $faq->faq_title !!}</h4>
                <p>
                    {!! $faq->faq_description !!}
                </p>
            </div>
            @endif
        @endforeach
    @endif
@endif