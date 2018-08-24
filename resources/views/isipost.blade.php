@extends('layout.home')
@section('content')
	<div class="container">

		<dir class="card p-3">
		
			<h1>{{$post->title}}</h1>
			<img style="width: 100%" src="/storage/cover_images/{{$post->cover_image}}">
			<br>

			
			<div>
				{!!$post->body!!} 
			</div>
			<hr> 
			<small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
			<hr>

		</dir>
		
	</div>

@endsection