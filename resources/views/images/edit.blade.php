<script src="//cdn.jsdelivr.net/npm/medium-editor@latest/dist/js/medium-editor.min.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/medium-editor@latest/dist/css/medium-editor.min.css" type="text/css" media="screen" charset="utf-8">
@extends('default')

@section('content')

@if($errors->any())
<div class="alert alert-danger">
	@foreach ($errors->all() as $error)
	{{ $error }} <br>
	@endforeach
</div>
@endif

{{ Form::model($image, array('route' => array('images.update', $image->id), 'method' => 'PUT')) }}

<div class="mb-3">
	{{ Form::label('name', 'Name', ['class'=>'form-label']) }}
	{{ Form::textarea('name', null, array('class' => 'form-control')) }}
</div>
<div class="mb-3">
	{{ Form::label('image', 'Image', ['class'=>'form-label']) }}
	{{ Form::textarea('image', null, array('class' => 'editable')) }}
</div>

{{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}
<script>
	var editor = new MediumEditor('.editable', {
		toolbar: {
			buttons: ['bold', 'italic', 'underline', 'anchor', 'h1', 'h2', 'h3', ],
		}
	});
</script>
@stop