@extends('default')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }} <br>
            @endforeach
        </div>
    @endif

    {!! Form::open(['route' => 'datapoints.store']) !!}

    <div class="mb-3">
        {{ Form::label('image', 'Image', ['class' => 'form-label']) }}
        {{ Form::text('image', null, ['class' => 'form-control']) }}
    </div>
    <div class="mb-3">
        {{ Form::label('value', 'Value', ['class' => 'form-label']) }}
        <div>
            @for ($i = 1; $i <= 5; $i++)
                <label class="radio-inline">
                    <input type="radio" name="value" id="value{{ $i }}" value="{{ $i }}">
                    {{ $i }}
                </label>
            @endfor
        </div>
    </div>

    <div class="mb-3">
        {{ Form::label('forenkey_tracker_id', 'Forenkey_tracker_id', ['class' => 'form-label']) }}
        {{ Form::text('forenkey_tracker_id', $trackerId, ['class' => 'form-control','readonly' => true]) }}
    </div>


    {{ Form::submit('Create', ['class' => 'btn btn-primary']) }}

    {{ Form::close() }}


@stop
