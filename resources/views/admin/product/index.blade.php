@extends('layouts.app')

@section('content')
	
	<h1>Products</h1>
	@if(count($products)>0)

		@foreach($products as $product)

			<div  class="card card-block my-3 p-2">

				<dir class="row">
					<div class="col-md-4 col-sm-4">
						<img style="width: 100%" src="/storage/product_images/{{$product->product_image}}">
						
					</div>
					<div class="col-md-8 col-sm-8">

						<h3><a href="/products/{{$product->id}}">{{$product->name}}</a></h3>
						<small>Written on {{$product->created_at}} by {{$product->user->name}}</small>

								
					</div>
				</dir>

				
			</div>

		@endforeach
		{{$products->links()}}

	@else
		<p class="my-4">No product found</p>

	@endif
	@if(!Auth::guest())

	<a href="/products/create" class="btn btn-primary">Create</a>
	@endif

@endsection