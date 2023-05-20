@extends('default')
@section('content')
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Trackers') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">


                        <div class="d-flex justify-content-end mb-3"><a href="{{ route('food_trackers.create') }}"
                                class="btn btn-info">Create</a>
                        </div>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>name</th>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($food_trackers as $food_tracker)
                                    <tr>
                                        <td>{{ $food_tracker->id }}</td>
                                        <td>{{ $food_tracker->name }}</td>

                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('food_trackers.show', [$food_tracker->id]) }}"
                                                    class="btn btn-info">Show</a>
                                                <a href="{{ route('food_trackers.edit', [$food_tracker->id]) }}"
                                                    class="btn btn-primary">Edit</a>
                                                <a href="{{ route('food_datapoints.index') }}?food_tracker_id={{ $food_tracker->id }}"
                                                    class="btn btn-secondary">View Datapoints</a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['food_trackers.destroy', $food_tracker->id]]) !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@stop
