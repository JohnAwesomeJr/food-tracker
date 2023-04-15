@extends('default')

@section('content')

	<h1>{{ $post->title }}</h1>

	@if($post->image)
		<img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}" style="width: 500px;">
	@endif

	<p>{{ $post->content }}</p>

	<a href="{{ route('posts.index') }}" class="btn btn-primary">Back</a>

@stop
