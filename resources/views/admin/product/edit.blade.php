@extends('layouts.app')

@section('content')

	<h1>Edit Product</h1>

	{!! Form::open(['action' => ['ProductsController@update', $product->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

			<div class="form-group">

				{{Form::label('name', 'Product Name')}}
				{{Form::text('name', $product->name, ['class'=>'form-control', 'placeholder' => 'Product Name'])}}
				
			</div>
			<div class="form-group">

				{{Form::label('description', 'Product Description')}}
				{{Form::textarea('description', $product->description, ['id' => 'article-ckeditor', 'class'=>'form-control', 'placeholder' => 'Body Text'])}}
				
			</div>
			<div class="form-group">
				{{Form::file('product_image')}}
			</div>
			{{Form::hidden('_method', 'PUT')}}
			{{Form::submit('Submit', ['class'=>'btn btn-primary '])}}
	    


		{!! Form::close() !!}

@endsection
