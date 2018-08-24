@extends('layouts.app')

@section('content')

	<div class="container">

		<a href="/adminproduct" class="btn btn-primary">Go Back</a>


		<dir class="card p-3">
		
			<h1>{{$product->title}}</h1>
			<img style="width: 100%" src="/storage/product_images/{{$product->product_image}}">
			<br>

			
			<div>
				{!!$product->body!!} 
			</div>
			<hr> 
			<small>Written on {{$product->created_at}} by {{$product->user->name}}</small>
			<hr>

		</dir>
		@if(!Auth::guest())
			@if(Auth::user()->id == $product->user_id)
				<a href="/products/{{$product->id}}/edit" class="btn btn-primary ">Edit</a>

				{!!Form::open(['action' => ['ProductsController@destroy', $product->id], 'method'=>'POST', 'class'=>'float-right'])!!}
					{{Form::hidden('_method', 'DELETE')}}
					{{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
				{!!Form::close()!!}
			@endif
		@endif
	</div>
	
@endsection
