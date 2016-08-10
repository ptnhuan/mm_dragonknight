<div class="row margin-bottom-12">
    <div class="col-md-12">
        <a href="{!! URL::route('groups.edit') !!}" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add New</a>
    </div>
</div>
<?php $posts = @$data['posts']; ?>

@if( ! $posts->isEmpty() )
<table class="table table-hover">
    <thead>
        <tr>
            <th>Group name</th>
            <th>Operations</th>
        </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
        <tr>
            <td style="width:90%">{!! $post->post_title !!}</td>
            <td style="width:10%">
                <a href="{!! URL::route('posts.edit', ['id' => $post->post_id]) !!}"><i class="fa fa-edit fa-2x"></i></a>
                <a href="{!! URL::route('posts.delete',['id' => $post->post_id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a>
                <span class="clearfix"></span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<span class="text-warning"><h5>No results found.</h5></span>
@endif
