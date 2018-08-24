@extends('layouts.app')

@section('content')

	<div class="container">

		<h1>Create Product	</h1>

		{!! Form::open(['action' => 'ProductsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

			<div class="form-group">

				{{Form::label('name', 'Product Name')}}
				{{Form::text('name', '', ['class'=>'form-control', 'placeholder' => 'Product Name'])}}
				
			</div>
			<div class="form-group">

				{{Form::label('description', 'Product Description')}}
				{{Form::textarea('description', '', ['id' => 'article-ckeditor', 'class'=>'form-control', 'placeholder' => 'Body Text'])}}
				
			</div>
			<div class="form-group">
				{{Form::file('product_image')}}
			</div>

			{{Form::submit('Submit', ['class'=>'btn btn-primary '])}}
	    


		{!! Form::close() !!}

	</div>

	
@endsection
