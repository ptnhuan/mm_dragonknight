<!-- TASK USER ID   -->
<div class="form-group">
    {!! Form::label('task_enrolls', trans('tasks.task_enrolls').':') !!}
    {!! Form::text('task_enrolls', null, ['class' => 'form-control', 'placeholder' => trans('tasks.task_enrolls').'']) !!}
    <span class="text-danger">{!! $errors->first('task_enrolls') !!}</span>
</div>


<div class="user-enrolled">
    <div class="row">
        <!--USER SEARCH-->
        <div class="col-md-8 user-search-list" style="display: none">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="width: 20%"><?php echo trans('tasks.user_name') ?></th>
                        <th style="width: 15%"><?php echo trans('tasks.user_email') ?></th>
                        <th style="width: 15%"><?php echo trans('tasks.task_action') ?></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

        <!--USER ENROLLED -->
        <div class="col-md-4">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="width: 40%"><?php echo trans('tasks.task_user_name') ?></th>
                        <th style="width: 15%"><?php echo trans('tasks.task_user_status') ?></th>
                        <th style="width: 15%"><?php echo trans('tasks.task_action') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>A</td>
                        <td>AA</td>
                        <td><i class="fa fa-times" aria-hidden="true"></i></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>



@section('footer_ajax_scripts')
<script>
    $("#task_enrolls").keypress(function () {
        $('.user-search-list tbody').empty();
        $('.user-search-list').show();
        $.ajax({
            type: "POST",
            url: "{!!  URL::route('ajax_user.search') !!}",
            data: {
                '_token': "{!! csrf_token() !!}",
                keyword: $("#task_enrolls").val()
            },
            success: function (data) {
                $('.user-list-search').show();
                $('.user-search-list tbody').empty();
                $('.user-search-list').show();

                if (data) {
                    var html_user_item = '';
                    var user_list = jQuery.parseJSON(data);
                    for (i = 0; i < user_list.length; i++) {
                        html_user_item =
                                '<tr> \n\
                                            <td>' + user_list[i].first_name + ' ' + user_list[i].first_name + '</td>  \n\
                                            <td>' + user_list[i].email + '</td>  \n\
                                            <td>  <a href="#" class="assign-task" ><i class="fa fa-arrow-right" aria-hidden="true"></i></a>   </td>                           \n\
                                        </tr>';
                        $('.user-search-list tbody').append(html_user_item);
                    }

                }
            },
            error: function (data) {
                console.log('error');
            }
        });
    });

    $('.assign-task').click(function(){
        
    });

</script>
@stop