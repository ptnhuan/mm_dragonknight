<div class="row margin-bottom-12">
    <div class="col-md-12">
        <a href="{!! URL::route('tasks.edit') !!}" class="btn btn-info pull-right"><i class="fa fa-plus"></i><?php echo trans('tasks.task_add') ?></a>
    </div>
</div>
<?php $tasks = @$data['tasks']; ?>

@if( ! $tasks->isEmpty() )
<table class="table table-hover">
    <thead>
        <tr>
            <th><?php echo trans('tasks.task_order') ?></th>
            <th><?php echo trans('tasks.task_title') ?></th>
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
                <td><?php echo $counter; $counter++; ?></td>
                <td>{!! $task->task_title !!}</td>
                <td>
                    <a href="{!! URL::route('tasks.edit', ['id' => $task->task_id]) !!}"><i class="fa fa-edit fa-2x"></i></a>
                    <a href="{!! URL::route('tasks.delete',['id' => $task->task_id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a>
                    <span class="clearfix"></span>
                </td>
            </tr>
            @endforeach
    </tbody>
</table>
@else
<span class="text-warning"><h5>No results found.</h5></span>
@endif
