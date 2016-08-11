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
            <!--ORDER-->
            <th style="width: 5%">
                <?php echo trans('statuses.status_order') ?>
            </th>

            <!--TITLE-->
            <th style="width: 35%">
                <?php echo trans('statuses.status_title') ?>
            </th>

            <!--ID-->
            <th style="width: 5%">
                <?php echo trans('statuses.status_id') ?>
            </th>

            <!--ACTION-->
            <th>
                <?php echo trans('statuses.status_action') ?>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        $nav = $statuses->toArray();
        $counter = ($nav['current_page'] - 1) * $nav['per_page'] + 1;
        ?>
        @foreach($statuses as $status)
        <tr>

            <!--ORDER-->
            <td>
                <?php
                echo $counter;
                $counter++;
                ?>
            </td>

            <!--TITLE-->
            <td>
                {!! $status->status_title !!}
            </td>

            <!--ID-->
            <td>
                {!! $status->status_id !!}
            </td>

            <!--ACTION-->
            <td>
                <a href="{!! URL::route('statuses.edit', ['id' => $status->status_id]) !!}"><i class="fa fa-edit fa-2x"></i></a>
                <a href="{!! URL::route('statuses.delete',['id' => $status->status_id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete">
                    <i class="fa fa-trash-o fa-2x"></i>
                </a>
                <span class="clearfix"></span>
            </td>

        </tr>
        @endforeach
    </tbody>
</table>
<div class="paginator">
    {!! $statuses->appends($data['request']->except(['page']) )->render() !!}
</div>
@else
<span class="text-warning"><h5>{!! trans('statuses.status_not_found') !!}</h5></span>
@endif
