<div class="row margin-bottom-12">
    <div class="col-md-12">
        <a href="{!! URL::route('categories.edit') !!}" class="btn btn-info pull-right"><i class="fa fa-plus"></i><?php echo trans('categories.category_add') ?></a>
    </div>
</div>
<?php $categories = @$data['categories']; ?>

@if( ! $categories->isEmpty() )
<table class="table table-hover">
    <thead>
        <tr>
            <th style="width: 5%"><?php echo trans('categories.category_order') ?></th>
            <th style="width: 40%"><?php echo trans('categories.category_title') ?></th>

            <th><?php echo trans('categories.category_action') ?></th>
        </tr>
    </thead>
    <tbody>

        <?php
        $nav = $categories->toArray();
        $counter = ($nav['current_page'] - 1) * $nav['per_page'] + 1;
        ?>
        @foreach($categories as $category)
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
                {!! $category->category_title !!}
            </td>


            <!--ACTION-->
            <td style="width:10%">
                <a href="{!! URL::route('categories.edit', ['id' => $category->category_id]) !!}"><i class="fa fa-edit fa-2x"></i></a>
                <a href="{!! URL::route('categories.delete',['id' => $category->category_id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a>
                <span class="clearfix"></span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
 <!--PAGINATION-->
<div class="paginator">
    {!! $categories->appends($data['request']->except(['page']) )->render() !!}
</div>
@else
<span class="text-warning"><h5>No results found.</h5></span>
@endif
