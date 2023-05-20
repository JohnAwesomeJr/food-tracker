@extends('default')

@section('content')
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit "{{ $food_tracker->name }}"
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

                        {{ Form::model($food_tracker, ['route' => ['food_trackers.update', $food_tracker->id], 'method' => 'PUT']) }}

                        <div class="mb-3">
                            {{ Form::label('name', 'Name', ['class' => 'form-label']) }}
                            {{ Form::text('name', null, ['class' => 'form-control']) }}
                        </div>

                        {{ Form::submit('Edit', ['class' => 'btn btn-primary']) }}

                        {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@stop
