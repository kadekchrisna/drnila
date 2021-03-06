@extends('layout.home')
@section('content')

	<div class="container">

		<h1>Posts</h1>
		@if(count($posts)>0)

			@foreach($posts as $post)

				<div  class="card card-block my-3 p-2">

					<dir class="row">
						<div class="col-md-4 col-sm-4">
							<img style="width: 100%" src="/storage/cover_images/{{$post->cover_image}}">
							
						</div>
						<div class="col-md-8 col-sm-8">

							<h3><a href="/post/{{$post->id}}">{{$post->title}}</a></h3>
							<small>Written on {{$post->created_at}} by {{$post->user->name}}</small>

									
						</div>
					</dir>

					
				</div>

			@endforeach
			{{$posts->links()}}

		@else
			<p>No post found</p>

		@endif
		
	</div>

@endsection