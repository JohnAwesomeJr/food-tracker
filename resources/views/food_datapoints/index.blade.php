@extends('default')

@section('content')
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Datapoints') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">



                        <div class="d-flex justify-content-end mb-3">
                            <a href="{{ route('food_trackers.index') }}" class="btn btn-warning">Back To Trackers</a>
                            <a href="{{ route('food_datapoints.create', ['food_tracker_id' => $food_tracker_id]) }}"
                                class="btn btn-info">Add a
                                Datapoint</a>
                        </div>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>image_file_name</th>
                                    <th>rating</th>
                                    <th>food_tracker_id</th>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($food_datapoints as $food_datapoint)
                                    <tr>
                                        <td>{{ $food_datapoint->id }}</td>
                                        <td>{{ $food_datapoint->image_file_name }}</td>
                                        <td>{{ $food_datapoint->rating }}</td>
                                        <td>{{ $food_datapoint->food_tracker_id }}</td>

                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('food_datapoints.show', [$food_datapoint->id]) }}"
                                                    class="btn btn-info">Show</a>
                                                <a href="{{ route('food_datapoints.edit', [$food_datapoint->id]) }}"
                                                    class="btn btn-primary">Edit</a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['food_datapoints.destroy', $food_datapoint->id]]) !!}
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
