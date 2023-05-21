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

                        {!! Form::open(['route' => 'food_datapoints.store', 'enctype' => 'multipart/form-data']) !!}

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
                        <div class="mb-3">
                            {{ Form::label('fileUpload', 'Image Upload', ['class' => 'form-label']) }}
                            {{ Form::file('fileUpload', ['class' => 'form-control', 'id' => 'fileUpload']) }}
                        </div>


                        {{ Form::submit('Create', ['class' => 'btn btn-primary']) }}

                        {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
    <script>
        // get the file input element
        const fileInput = document.getElementById("fileUpload");

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
                        const resizedFile = new File([blob], file.name, {
                            type: file.type
                        });
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
