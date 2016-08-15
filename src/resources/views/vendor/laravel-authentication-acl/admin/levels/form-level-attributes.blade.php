<!-- LEVEL POINT -->
<div class="form-group">
    {!! Form::label('level_points', trans('levels.level_points').':') !!}
    {!! Form::text('level_points', @$level->level_points, ['class' => 'form-control',
    'placeholder' => trans('levels.level_points').'']) !!}
    <span class="text-danger">{!! $errors->first('level_points') !!}</span>
</div>



