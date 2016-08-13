<!-- TASK USER ID   -->
<div class="form-group">
    {!! Form::label('user_enrolls', trans('tasks.task_enrolls').':') !!}
    {!! Form::text('user_enrolls', null, ['class' => 'form-control', 'placeholder' => trans('tasks.task_enrolls').'']) !!}
    <span class="text-danger">{!! $errors->first('user_enrolls') !!}</span>
</div>


<div class="user-list">
    <div class="row">

        <!--USER SEARCH-->
        <div class="col-md-7 user-search" style="display: none">
            <h4>Thêm users</h4>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="width: 20%"><?php echo trans('tasks.user_name') ?></th>
                        <th style="width: 15%"><?php echo trans('tasks.user_email') ?></th>
                        <th style="width: 15%"><?php echo trans('tasks.task_action') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <!--AJAX CONTENT-->
                </tbody>
            </table>
        </div>

        <!--USER ENROLLED -->
        <div class="col-md-5 user-enrolled">
            <h4>Đã giao task</h4>
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
                        <td>AA
                             {!! Form::hidden('user_ids[]', 0) !!}
                        </td>
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
    $("#user_enrolls").keypress(function () {
        $('.user-search tbody').empty();
        $('.user-search').show();
        $.ajax({
            type: "POST",
            url: "{!!  URL::route('ajax_user.search') !!}",
            data: {
                '_token': "{!! csrf_token() !!}",
                keyword: $("#user_enrolls").val()
            },
            success: function (data) {
                $('.user-search tbody').empty();
                $('.user-search').show(); 
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
                        $('.user-search tbody').append(html_user_item);
                    } 
                }
            },
            error: function (data) {
                $('.user-search').empty();
                $('.user-search').append('<h4>Không tìm thấy</h4>');
            }
        });
    });

    $('.assign-task').click(function(){

    });

</script>
@stop