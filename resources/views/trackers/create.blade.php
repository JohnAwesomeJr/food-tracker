@extends('default')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }} <br>
            @endforeach
        </div>
    @endif

    {!! Form::open(['route' => 'trackers.store']) !!}

    <div class="mb-3">
        {{ Form::label('trackName', 'TrackName', ['class' => 'form-label']) }}
        {{ Form::text('trackName', null, ['class' => 'form-control']) }}
    </div>
    <div class="mb-3">
        {{ Form::label('forenkey_user_id', 'Forenkey_user_id', ['class' => 'form-label']) }}
        {{ Form::number('forenkey_user_id', null, ['class' => 'form-control']) }}
    </div>


    {{ Form::submit('Create', ['class' => 'btn btn-primary']) }}

    {{ Form::close() }}


@stop
