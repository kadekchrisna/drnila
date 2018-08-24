@extends('layout.home')
@section('content')
<div class="container">
	@if(count($product)>0)

	<div class="row">
		@foreach($product as $product)
		<div class="col-sm-6 col-md-4 col-lg-3">

			<div class="card mb-2">

				<div class="card-body">
					<img style="width: 100%" src="/storage/product_images/{{$product->product_image}}">
					<h3 class="my-2"><a  href="/products/{{$product->id}}">{{$product->name}}</a></h3>

					<p class="text-justify">{!!$product->description!!}</p>
					<small>Written on {{$product->created_at}} by {{$product->user->name}}</small>
					
				</div>
				
			</div>
			
		</div>
		@endforeach
	</div>
	@else
		<p>No Product found</p>

	@endif
</div>


@endsection