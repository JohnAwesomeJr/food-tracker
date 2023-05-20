@extends('default')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }} <br>
            @endforeach
        </div>
    @endif

    {!! Form::open(['route' => 'datapoints.store', 'enctype' => 'multipart/form-data']) !!}

    <div class="mb-3">
        {{ Form::label('image', 'Image', ['class' => 'form-label']) }}
        {{ Form::text('image', null, ['class' => 'form-control']) }}
    </div>
    <div class="mb-3">
        {{ Form::label('value', 'Value', ['class' => 'form-label']) }}
        <div>
            @for ($i = 1; $i <= 5; $i++)
                <label class="radio-inline">
                    <input type="radio" name="value" id="value{{ $i }}" value="{{ $i }}">
                    {{ $i }}
                </label>
            @endfor
        </div>
    </div>
    <div class="mb-3">
        {{ Form::label('imageFile', 'Image', ['class' => 'form-label']) }}
        {{ Form::file('imageFile', ['class' => 'form-control', 'id' => 'imageFile']) }}
    </div>

    <div class="mb-3">
        {{ Form::label('forenkey_tracker_id', 'Forenkey_tracker_id', ['class' => 'form-label']) }}
        {{ Form::text('forenkey_tracker_id', $trackerId, ['class' => 'form-control', 'readonly' => true]) }}
    </div>


    {{ Form::submit('Create', ['class' => 'btn btn-primary']) }}

    {{ Form::close() }}

    <script>
        // get the file input element
        const fileInput = document.getElementById("imageFile");

        // add an event listener for when the user selects a file
        fileInput.addEventListener("change", function(event) {
            // get the selected file
            const file = event.target.files[0];

            // create a new FileReader object
            const reader = new FileReader();

            // set up a function to run when the FileReader has finished reading the file
            reader.onload = function(event) {
                // create a new image object
                const image = new Image();

                // set up a function to run when the image has finished loading
                image.onload = function() {
                    // create a canvas element
                    const canvas = document.createElement("canvas");

                    // set the canvas size to 200 pixels wide and proportional height
                    const aspectRatio = image.width / image.height;
                    canvas.width = 200;
                    canvas.height = 200 / aspectRatio;

                    // draw the image onto the canvas at the new size
                    const context = canvas.getContext("2d");
                    context.drawImage(image, 0, 0, canvas.width, canvas.height);

                    // convert the canvas to WebP format
                    canvas.toBlob(function(blob) {
                        // create a new File object with the converted WebP blob
                        const convertedFile = new File([blob], file.name, {
                            type: 'image/webp'
                        });

                        // update the file input with the converted file
                        const newFileList = new DataTransfer();
                        newFileList.items.add(convertedFile);
                        fileInput.files = newFileList.files;
                    }, 'image/webp', 1); // specify the quality (1 = highest)

                };

                // set the image source to the data URL from the FileReader
                image.src = event.target.result;
            };

            // read the selected file as a data URL
            reader.readAsDataURL(file);
        });
    </script>


@stop
