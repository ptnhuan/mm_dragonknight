<!-- TASK USER ID   -->
<div class="form-group">
    {!! Form::label('task_enrolls', trans('tasks.task_enrolls').':') !!}
    {!! Form::text('task_enrolls', null, ['class' => 'form-control', 'placeholder' => trans('tasks.task_enrolls').'']) !!}
    <b class='user-search'>Search</b>
    <span class="text-danger">{!! $errors->first('task_enrolls') !!}</span>
</div>


<div class="user-enrolled">
    <div class="row">
        <!--USER SEARCH-->
        <div class="col-md-8 user-search-list">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="width: 20%"><?php echo trans('tasks.user_avatar') ?></th>
                        <th style="width: 20%"><?php echo trans('tasks.user_name') ?></th>
                        <th style="width: 15%"><?php echo trans('tasks.user_email') ?></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <div class="col-md-1">

        </div>
        <!--USER ENROLLED -->
        <div class="col-md-3">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="width: 40%"><?php echo trans('tasks.task_title') ?></th>
                        <th style="width: 15%"><?php echo trans('tasks.task_status') ?></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

    </div>
</div>



@section('footer_ajax_scripts')
<script>
    $("#task_enrolls").keypress(function () {
        $('.user-search-list tbody').empty();
        $.ajax({
            type: "POST",
            url: "{!!  URL::route('ajax_user.search') !!}",
            data: {
                '_token': "{!! csrf_token() !!}",
                keyword: $("#task_enrolls").val()
            },
            success: function (data) {
                $('.user-list-search').show();
                if (data) {
                    var html_user_item = '';
                    var user_list = jQuery.parseJSON(data);
                    for (i = 0; i < user_list.length; i++) {
                        html_user_item =
                                '<tr> \n\
                                            <td>' + user_list[i].id + '</td>  \n\
                                            <td>' + user_list[i].first_name + ' ' + user_list[i].first_name + '</td>  \n\
                                            <td>' + user_list[i].email + '</td>  \n\
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

</script>
@stop