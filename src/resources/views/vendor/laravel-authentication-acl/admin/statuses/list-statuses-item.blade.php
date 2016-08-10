<div class="row margin-bottom-12">
    <div class="col-md-12">
        <a href="{!! URL::route('statuses.edit') !!}" class="btn btn-info pull-right">
            <i class="fa fa-plus"><?php echo trans('statuses.status_add') ?></i>
        </a>
    </div>
</div>
<?php $statuses = @$data['statuses']; ?>

@if( ! $statuses->isEmpty() )
<table class="table table-hover">
    <thead>
        <tr>
            <th style="width: 5%"><?php echo trans('statuses.status_order') ?></th>
            <th style="width:70%"><?php echo trans('statuses.status_title') ?></th>
            <th><?php echo trans('statuses.status_action') ?></th>
        </tr>
    </thead>
    <tbody>
        @foreach($statuses as $status)
        <tr>
            <td></td>
            <td>{!! $status->status_title !!}</td>
            <td>
                <a href="{!! URL::route('statuses.edit', ['id' => $status->status_id]) !!}"><i class="fa fa-edit fa-2x"></i></a>
                <a href="{!! URL::route('statuses.delete',['id' => $status->status_id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a>
                <span class="clearfix"></span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<span class="text-warning"><h5>No results found.</h5></span>
@endif
