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
                    <!--ASSIGNED USER-->
                    @if(!empty($data['users_tasks']))
                    @foreach($data['users_tasks'] as $user_task)
                    <tr>
                        <td>
                            {!! $user_task->first_name .' '. $user_task->last_name !!}
                            {!! Form::hidden('user_ids[]',$user_task->user_id) !!}
                        </td>
                        <td>{!! Form::select('status_ids[]', @$data['statuses'], $user_task->status_id, ['class' => 'form-control']) !!}</td>
                        <td><a href="#" class="remove-enrolled"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>

    </div>
</div>



@section('footer_ajax_scripts')
<script>
    /**
     * Search user by keyword
     */
    var timeout;
    $("#user_enrolls").keypress(function () {
        $('.user-search tbody').empty();
        $('.user-search').show();
        if(timeout) {
            clearTimeout(timeout);
            timeout = null;
        }
        timeout  = setTimeout(function () {
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
                                    <td>\n\
                                        ' + user_list[i].first_name + ' ' + user_list[i].first_name + '</td>  \n\
                                    <td>' + user_list[i].email + '</td>  \n\
                                    <td>  \n\
                                        <a href="#" class="assign-task" > \n\
                                            <i class="fa fa-arrow-right" aria-hidden="true"></i>\n\
                                            <input type="hidden" class="user-id" value="' + user_list[i].id + '">\n\
                                            <input type="hidden" class="user-name" value="' + user_list[i].first_name + ' ' + user_list[i].first_name + '">\n\
                                        </a>   \n\
                                    </td>\n\
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

        }, 1000);
    });//End search

    $('.remove-enrolled').click(function () {
        $(this).parent().parent().remove();
    });

    $(document).on('click', '.assign-task', function () {
        var user_id = $(this).children('.user-id').val();
        var user_name = $(this).children('.user-name').val();
        var html_enrolled = '<tr>\n\
                                                    <td>\n\
                                                        ' + user_name + '\n\
                                                        <input type="hidden" name="user_ids[]" value="' + user_id + '"\n\
                                                    </td>\n\
                                                    <td>\n\
                                                    ' + $('#status_id').clone().prop({name: "status_ids[]"}).get(0).outerHTML +'\n\
                                                    </td>\n\
                                                    <td><a href="#" class="remove-enrolled"><i class="fa fa-times" aria-hidden="true"></i></a></td>\n\
                                                </tr>';
        $('.user-enrolled tbody').append(html_enrolled);
        $('.remove-enrolled').click(function () {
            $(this).parent().parent().remove();
        });
    });

</script>
@stop