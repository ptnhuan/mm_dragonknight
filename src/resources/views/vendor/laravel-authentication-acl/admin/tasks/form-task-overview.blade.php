<?php
$messages = array(
    'task_title' => '',
    'task_overview' => '',
    'task_description' => '',
);
$errors = @$data['errors'];
if ($errors && !empty($errors->first('task_title'))) {
    $messages['task_title'] = $errors->first('task_title');
}
if ($errors && !empty($errors->first('task_overview'))) {
    $messages['task_overview'] = $errors->first('task_overview');
}
if ($errors && !empty($errors->first('task_description'))) {
    $messages['task_description'] = $errors->first('task_description');
}
?>
<!-- TASK TITLE -->
<div class="form-group">
    {!! Form::label('task_title', trans('tasks.task_title').':') !!}
    {!! Form::text('task_title', @$task->task_title, ['class' => 'form-control', 'placeholder' => trans('tasks.task_title').'']) !!}
    <span class="text-danger">{!! $messages['task_title'] !!}</span>
</div>

<!-- TASK OVERVIEW -->
<div class="form-group">
    {!! Form::label('task_overview', trans('tasks.task_overview').':') !!}
    {!! Form::textarea ('task_overview', @$task->task_overview, ['class' => 'form-control tinymce', 'placeholder' => trans('tasks.task_overview').'']) !!}
    <span class="text-danger">{!! $messages['task_overview'] !!}</span>
</div>

<!-- TASK DESCRIPTION   -->
<div class="form-group">
    {!! Form::label('task_description', trans('tasks.task_description').':') !!}
    {!! Form::textarea ('task_description', @$task->task_description, ['class' => 'form-control tinymce', 'rows' => 30, 'placeholder' => trans('tasks.task_description').'']) !!}
    <span class="text-danger">{!! $messages['task_description'] !!}</span>
</div>

@section('footer_scripts_tab1')
<script>
    $(document).ready(function () {
        var editor_config = {
            path_absolute: "/",
            selector: ".tinymce",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            relative_urls: false,
            file_browser_callback: function (field_name, url, type, win) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;
                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                console.log(cmsURL);
                if (type == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.open({
                    file: cmsURL,
                    title: 'Filemanager',
                    width: x * 0.8,
                    height: y * 0.8,
                    resizable: "yes",
                    close_previous: "no"
                });
            }
        };
        tinymce.init(editor_config);


    });
</script>


@stop