@extends('default')

@section('content')

    <div class="d-flex justify-content-end mb-3"><a href="{{ route('images.create') }}" class="btn btn-info">Create</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>image</th>

                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($images as $image)
                <tr>
                    <td>{{ $image->id }}</td>
                    <td>{{ $image->name }}</td>
                    <td>{{ $image->image }}</td>

                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('images.show', [$image->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('images.edit', [$image->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['images.destroy', $image->id]]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@stop
