<div class="row margin-bottom-12">
    <div class="col-md-12">
        <a href="{!! URL::route('faqs.edit') !!}" class="btn btn-info pull-right"><i class="fa fa-plus"></i><?php echo trans('faqs.faq_add') ?></a>
    </div>
</div>
<?php $faqs = @$data['faq']; ?>

@if( !$faqs->isEmpty() )
<table class="table table-hover">
    <thead>
        <tr>
            <th style="width: 5%"><?php echo trans('faqs.faq_order') ?></th>
            <th style="width: 40%"><?php echo trans('faqs.faq_title') ?></th>
            <th style="width: 15%"><?php echo trans('faqs.faq_status') ?></th>
            <th><?php echo trans('faqs.faq_action') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $nav = $faqs->toArray();
        $counter = ($nav['current_page'] - 1) * $nav['per_page'] + 1;
        ?>
        @foreach($faqs as $faq)
        <tr>
            <!--ORDER-->
            <td><?php echo $counter;
        $counter++; ?></td>

            <!--TITLE-->
            <td>{!! $faq->faq_title !!}</td>

            <!--STATUS-->
            <td>{!! @$data['statuses'][$faq->status_id] !!}</td>

            <!--ACTION-->
            <td>
                <a href="{!! URL::route('faqs.edit', ['id' => $faq->faq_id]) !!}"><i class="fa fa-edit fa-2x"></i></a>
                <a href="{!! URL::route('faqs.delete',['id' => $faq->faq_id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a>
                <span class="clearfix"></span>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
<div class="paginator">
    {!! $faqs->appends($data['request']->except(['page']) )->render() !!}
</div>
@else
<span class="text-warning"><h5>No results found.</h5></span>
@endif
