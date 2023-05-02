@extends('default')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }} <br>
            @endforeach
        </div>
    @endif

    {{ Form::model($datapoint, ['route' => ['datapoints.update', $datapoint->id], 'method' => 'PUT']) }}

    <div class="mb-3">
        {{ Form::label('image', 'Image', ['class' => 'form-label']) }}
        {{ Form::text('image', null, ['class' => 'form-control']) }}
    </div>
    <div class="mb-3">
        {{ Form::label('value', 'Value', ['class' => 'form-label']) }}
        <div>
            @for ($i = 1; $i <= 5; $i++)
                <label class="radio-inline">
                    {{ Form::radio('value', $i, $datapoint->value == $i, ['id' => "value{$i}"]) }}
                    {{ $i }}
                </label>
            @endfor
        </div>
    </div>

    <div class="mb-3">
        {{ Form::label('forenkey_tracker_id', 'Forenkey_tracker_id', ['class' => 'form-label']) }}
        {{ Form::text('forenkey_tracker_id', null, ['class' => 'form-control']) }}
    </div>
    <div class="mb-3">
        {{ Form::label('forenkey_user_id', 'Forenkey_user_id', ['class' => 'form-label']) }}
        {{ Form::text('forenkey_user_id', null, ['class' => 'form-control']) }}
    </div>

    {{ Form::submit('Edit', ['class' => 'btn btn-primary']) }}

    {{ Form::close() }}
@stop
