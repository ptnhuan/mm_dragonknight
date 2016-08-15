<!-- TASK NOTES   -->
<div class="form-group">
    {!! Form::label('faq_notes', trans('faqs.faq_notes').':') !!}
    {!! Form::text('faq_notes', @$faq->faq_notes, ['class' => 'form-control', 'placeholder' => trans('faqs.faq_notes').'']) !!}
    <span class="text-danger">{!! $errors->first('faq_notes') !!}</span>
</div>

<!-- TASK STATUS -->
<div class="form-group">
    {!! Form::label('status_id', trans('faqs.faq_status').':') !!}
    {!! Form::select('status_id', @$data['statuses'], @$faq->status_id, ['class' => 'form-control']) !!}

    <span class="text-danger">{!! $errors->first('status_id') !!}</span>
</div>

<!-- FAQ LIKE -->
<div class="form-group">
    {!! Form::label('faq_points', trans('faqs.faq_points').':') !!}
    {!! Form::text('faq_points', @$faq->faq_points, ['class' => 'form-control', 'placeholder' => trans('faqs.faq_points').'']) !!}
    <span class="text-danger">{!! $errors->first('faq_points') !!}</span>
</div>



