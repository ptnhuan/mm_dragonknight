<div class="faq-item">
    <div class="faq-question">
        <h4>{!! $faq->faq_title !!}</h4>
        <p>
            {!! $faq->faq_description !!}
        </p>
    </div>
    @if (!empty($faq_answers))

        @foreach($faq_answers as $faq)
            <div class="faq-answers">
                <p>
                    >>{!!  $faq->faq_description !!}
                </p>
            </div>
        @endforeach

    @endif
</div>