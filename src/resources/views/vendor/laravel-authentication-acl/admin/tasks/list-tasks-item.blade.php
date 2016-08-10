<div class="row margin-bottom-12">
    <div class="col-md-12">
        <a href="{!! URL::route('tasks.edit') !!}" class="btn btn-info pull-right"><i class="fa fa-plus"></i><?php echo trans('tasks.task_add') ?></a>
    </div>
</div>
<?php $tasks = @$data['tasks']; ?>

@if( !$tasks->isEmpty() )
<table class="table table-hover">
    <thead>
        <tr>
            <th style="width: 5%"><?php echo trans('tasks.task_order') ?></th>
            <th style="width: 40%"><?php echo trans('tasks.task_title') ?></th>
            <th style="width: 15%"><?php echo trans('tasks.task_status') ?></th>
            <th><?php echo trans('tasks.task_action') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $nav = $tasks->toArray();
        $counter = ($nav['current_page'] - 1) * $nav['per_page'] + 1;
        ?>
        @foreach($tasks as $task)
        <tr>
            <!--ORDER-->
            <td><?php echo $counter;
        $counter++; ?></td>

            <!--TITLE-->
            <td>{!! $task->task_title !!}</td>

            <!--STATUS-->
            <td>{!! @$data['statuses'][$task->status_id] !!}</td>

            <!--ACTION-->
            <td>
                <a href="{!! URL::route('tasks.edit', ['id' => $task->task_id]) !!}"><i class="fa fa-edit fa-2x"></i></a>
                <a href="{!! URL::route('tasks.delete',['id' => $task->task_id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a>
                <span class="clearfix"></span>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
<div class="paginator">
    {!! $tasks->appends($data['request']->except(['page']) )->render() !!}
</div>
@else
<span class="text-warning"><h5>No results found.</h5></span>
@endif
