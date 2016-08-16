<div class="row margin-bottom-12">
    <div class="col-md-12">
        <a href="{!! URL::route('categories.edit') !!}" class="btn btn-info pull-right"><i class="fa fa-plus"></i><?php echo trans('categories.category_add') ?></a>
    </div>
</div>
<?php $comments = @$data['comments']; ?>
@if( ! $comments->isEmpty() )
<table class="table table-hover">
    <thead>
        <tr>
            <th style="width: 5%"><?php echo trans('comments.comment_user_name') ?></th>
            <th style="width: 40%"><?php echo trans('comments.comment_overview') ?></th>
            <th style="width: 10%"><?php echo trans('comments.comment_likes') ?></th>

            <th><?php echo trans('categories.category_action') ?></th>
        </tr>
    </thead>
    <tbody>

        <?php
        $nav = $comments->toArray();
        $counter = ($nav['current_page'] - 1) * $nav['per_page'] + 1;
        ?>
        @foreach($comments as $comment)
        <tr>
            <!--ORDER-->
            <td>
                <?php
                echo $counter;
                $counter++;
                ?>
            </td>

            <!--USERNAME-->
            <td>
                {!! @$comment->user_id !!}
            </td>

            <!--LIKES-->
            <td>
                {!! @$comment->comment_likes !!}
            </td>

            <!--ACTION-->
            <td style="width:10%">
                <a href="{!! URL::route('comments.edit', ['id' => $comment->comment_id]) !!}">
                    <i class="fa fa-edit fa-2x"></i></a>
                <a href="{!! URL::route('comments.delete',['id' => $comment->comment_id, '_token' => csrf_token()]) !!}"
                   class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i>
                </a>
                <span class="clearfix"></span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
 <!--PAGINATION-->
<div class="paginator">
    {!! $comments->appends($data['request']->except(['page']) )->render() !!}
</div>
@else
<span class="text-warning"><h5>No results found.</h5></span>
@endif
