<div class="row margin-bottom-12">
    <div class="col-md-12">
        <a href="{!! URL::route('posts.edit') !!}" class="btn btn-info pull-right"><i class="fa fa-plus"></i><?php echo trans('posts.post_add') ?></a>
    </div>
</div>
<?php $posts = @$data['posts']; ?>

@if( !$posts->isEmpty() )
<table class="table table-hover">
    <thead>
        <tr>
            <th style="width: 5%"><?php echo trans('posts.post_order') ?></th>
            <th style="width: 40%"><?php echo trans('posts.post_title') ?></th>
            <th style="width: 15%"><?php echo trans('posts.post_status') ?></th>
            <th><?php echo trans('posts.post_action') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $nav = $posts->toArray();
        $counter = ($nav['current_page'] - 1) * $nav['per_page'] + 1;
        ?>
        @foreach($posts as $post)
        <tr>
            <!--ORDER-->
            <td><?php echo $counter; $counter++; ?></td>

            <!--TITLE-->
            <td>{!! $post->post_title !!}</td>

            <!--STATUS-->
            <td>{!! @$data['statuses'][$post->status_id] !!}</td>

            <!--ACTION-->
            <td>
                <a href="{!! URL::route('posts.edit', ['id' => $post->post_id]) !!}"><i class="fa fa-edit fa-2x"></i></a>
                <a href="{!! URL::route('posts.delete',['id' => $post->post_id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a>
                <span class="clearfix"></span>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
<div class="paginator">
    {!! $posts->appends($data['request']->except(['page']) )->render() !!}
</div>
@else
<span class="text-warning"><h5>No results found.</h5></span>
@endif
