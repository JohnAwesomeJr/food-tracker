@extends('default')

@section('content')

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('datapoints.create', ['tracker_id' => $trackerId]) }}" class="btn btn-info">
            Create
        </a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>id</th>
                <th>image</th>
                <th>value</th>
                <th>forenkey_tracker_id</th>
                <th>forenkey_user_id</th>

                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datapoints as $datapoint)
                <tr>
                    {{-- <td>{{ $datapoint->id }}</td> --}}
                    <td><img src="/storage/images/{{ $datapoint->image }}" style="height:40px;"></td>
                    <td>{{ $datapoint->value }}</td>
                    {{-- <td>{{ $datapoint->forenkey_tracker_id }}</td> --}}
                    {{-- <td>{{ $datapoint->forenkey_user_id }}</td> --}}

                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('datapoints.show', [$datapoint->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('datapoints.edit', [$datapoint->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['datapoints.destroy', $datapoint->id]]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $datapoints->links() }}


@stop
