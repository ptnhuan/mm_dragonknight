<div class="row margin-bottom-12">
    <div class="col-md-12">
        <a href="{!! URL::route('levels.edit') !!}" class="btn btn-info pull-right">
            <i class="fa fa-plus"></i>
                <?php echo trans('levels.level_add') ?>
        </a>
    </div>
</div>
<?php $levels = @$data['levels']; ?>

@if( !$levels->isEmpty() )
<table class="table table-hover">
    <thead>
        <tr>
            <th style="width: 5%"><?php echo trans('levels.level_order') ?></th>
            <th style="width: 75%"><?php echo trans('levels.level_title') ?></th>
            <th><?php echo trans('levels.level_action') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $nav = $levels->toArray();
        $counter = ($nav['current_page'] - 1) * $nav['per_page'] + 1;
        ?>
        @foreach($levels as $level)
        <tr>
            <!--ORDER-->
            <td>
                <?php echo $counter; $counter++; ?>
            </td>

            <!--TITLE-->
            <td>{!! $level->level_title !!}</td>

            <!--ACTION-->
            <td>
                <a href="{!! URL::route('levels.edit', ['id' => $level->level_id]) !!}">
                    <i class="fa fa-edit fa-2x"></i>
                </a>
                <a href="{!! URL::route('levels.delete',['id' => $level->level_id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete">
                    <i class="fa fa-trash-o fa-2x"></i>
                </a>
                <span class="clearfix"></span>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
<div class="paginator">
    {!! $levels->appends($data['request']->except(['page']) )->render() !!}
</div>
@else
<span class="text-warning"><h5>No results found.</h5></span>
@endif
