@extends('default')

@section('content')
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }} <br>
            @endforeach
        </div>
    @endif

    {!! Form::open(['route' => 'posts.store', 'enctype' => 'multipart/form-data']) !!}
        <div class="mb-3">
            {{ Form::label('title', 'Title', ['class'=>'form-label']) }}
            {{ Form::text('title', null, array('class' => 'form-control')) }}
        </div>
        <div class="mb-3">
            {{ Form::label('content', 'Content', ['class'=>'form-label']) }}
            {{ Form::textarea('content', null, array('class' => 'form-control')) }}
        </div>
        <div class="mb-3">
            {{ Form::label('image', 'Image', ['class'=>'form-label']) }}
            {{ Form::file('image', array('class' => 'form-control')) }}
        </div>
        {{ Form::submit('Create', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}

    <script>
        // get the file input element
        const fileInput = document.getElementById("image");

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

                    // convert the canvas back to a file and update the file input with the resized image
                    canvas.toBlob(function(blob) {
                        const resizedFile = new File([blob], file.name, {type: file.type});
                        const newFileList = new DataTransfer();
                        newFileList.items.add(resizedFile);
                        fileInput.files = newFileList.files;
                    }, file.type);
                };

                // set the image source to the data URL from the FileReader
                image.src = event.target.result;
            };

            // read the selected file as a data URL
            reader.readAsDataURL(file);
        });
    </script>
@stop
