<?php $users_tasks = @$data['users_tasks']; ?>
 

@if( !$users_tasks->isEmpty() )
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
        $nav = $users_tasks->toArray();
        $counter = ($nav['current_page'] - 1) * $nav['per_page'] + 1;
        ?>
        @foreach($users_tasks as $user_task)
        <tr>
            <!--ORDER-->
            <td><?php echo $counter; $counter++; ?></td>

            <!--TITLE-->
            <td>{!! $user_task->task_id !!}</td>

            <!--STATUS-->
            <td>{!! @$data['statuses'][$user_task->status_id] !!}</td>

            <!--ACTION-->
            <td>
                <a href="{!! URL::route('users_tasks.edit', ['id' => $user_task->user_task_id]) !!}"><i class="fa fa-edit fa-2x"></i></a>
                <span class="clearfix"></span>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
<div class="paginator">
    {!! $users_tasks->appends($data['request']->except(['page']) )->render() !!}
</div>
@else
<span class="text-warning"><h5>No results found.</h5></span>
@endif
