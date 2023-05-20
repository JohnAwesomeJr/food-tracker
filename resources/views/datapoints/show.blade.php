@extends('default')

@section('content')
    <a href="{{ url()->previous() }}" class="btn btn-info">back</a>
    <br>
    id: <b>{{ $datapoint->id }}</b>
    <img src="/storage/images/{{ $datapoint->image }}">

@stop
