@extends('default')

@section('content')
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add New Datapoint') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">


                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    {{ $error }} <br>
                                @endforeach
                            </div>
                        @endif

                        {!! Form::open(['route' => 'food_datapoints.store']) !!}

                        <div class="mb-3">
                            {{ Form::label('image_file_name', 'Image_file_name', ['class' => 'form-label']) }}
                            {{ Form::text('image_file_name', null, ['class' => 'form-control']) }}
                        </div>
                        <div class="mb-3">
                            {{ Form::label('rating', 'Rating', ['class' => 'form-label']) }}
                            {{ Form::text('rating', null, ['class' => 'form-control']) }}
                        </div>
                        <div class="mb-3">
                            {{ Form::label('food_tracker_id', 'Food_tracker_id', ['class' => 'form-label']) }}
                            {{ Form::text('food_tracker_id', app('request')->input('food_tracker_id'), ['class' => 'form-control', 'readonly' => true]) }}
                        </div>


                        {{ Form::submit('Create', ['class' => 'btn btn-primary']) }}

                        {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

@stop
