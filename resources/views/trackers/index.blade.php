@extends('default')

@section('content')

    <div class="d-flex justify-content-end mb-3"><a href="{{ route('trackers.create') }}" class="btn btn-info">Create</a></div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>id</th>
                <th>trackName</th>
                <th>forenkey_user_id</th>

                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trackers as $tracker)
                <tr>
                    <td>{{ $tracker->id }}</td>
                    <td>{{ $tracker->trackName }}</td>
                    <td>{{ $tracker->forenkey_user_id }}</td>

                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('trackers.show', [$tracker->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('trackers.edit', [$tracker->id]) }}" class="btn btn-primary">Edit</a>
                            <a href="/datapoints/trackerid/{{ $tracker->id }}" class="btn btn-secondary">View Datapoints</a>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['trackers.destroy', $tracker->id]]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

@stop
