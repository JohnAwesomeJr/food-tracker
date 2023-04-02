@extends('default')

@section('content')

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }} <br>
            @endforeach
        </div>
    @endif

    {!! Form::open(['route' => 'posts.store', 'enctype' => 'multipart/form-data']) !!}

        <div class="mb-3">
            {{ Form::label('title', 'Title', ['class'=>'form-label']) }}
            {{ Form::text('title', null, array('class' => 'form-control')) }}
        </div>
        <div class="mb-3">
            {{ Form::label('content', 'Content', ['class'=>'form-label']) }}
            {{ Form::textarea('content', null, array('class' => 'form-control')) }}
        </div>
        <div class="mb-3">
            {{ Form::label('image', 'Image', ['class'=>'form-label']) }}
            {{ Form::file('image', array('class' => 'form-control')) }}
        </div>

        {{ Form::submit('Create', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

@stop
