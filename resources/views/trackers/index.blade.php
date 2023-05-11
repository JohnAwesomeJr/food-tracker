@extends('default')


@section('content')

    <div class="d-flex justify-content-end mb-3"><a href="{{ route('trackers.create') }}" class="btn btn-info">Create</a></div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">trackName</th>
                <!-- <th scope="col">forenkey_user_id</th> -->

                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trackers as $tracker)
                <tr>
                    <td scope="row">{{ $tracker->id }}</td>
                    <td>{{ $tracker->trackName }}</td>
                    <!-- <td>{{ $tracker->forenkey_user_id }}</td> -->

                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('trackers.show', [$tracker->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('trackers.edit', [$tracker->id]) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('datapoints.index') }}?tracker_id={{ $tracker->id }}" class="btn btn-secondary">View Datapoints</a>
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