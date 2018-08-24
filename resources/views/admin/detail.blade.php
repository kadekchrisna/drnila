@extends('layouts.app')

@section('content')

	<div class="container">

		<a href="/adminpost" class="btn btn-primary">Go Back</a>


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
		@if(!Auth::guest())
			@if(Auth::user()->id == $post->user_id)
				<a href="/posts/{{$post->id}}/edit" class="btn btn-primary ">Edit</a>

				{!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method'=>'POST', 'class'=>'float-right'])!!}
					{{Form::hidden('_method', 'DELETE')}}
					{{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
				{!!Form::close()!!}
			@endif
		@endif
	</div>
	
@endsection
