@extends('admin.layouts.master')


@section('content')

     
     @include('admin.includes.errors')


       <div class="page-header">
      	<h1>@lang('category.catupdate'):{{$category->name}}</h1>
      </div>
<div class="panel panel-default">
      <div class="panel-body">
      	<form action="{{ route('admin.category.update', ['id'=>$category->id]) }}" method="POST">
      		
      		{{ csrf_field() }}

            <div class="form-group">
            	<label for="name">Category Name</label>
            	<input type="text" name="name" value="{{ $category->name }}" placeholder="Enter Your Blog Category Name" class="form-control"><br>
              <p>@lang('posts.link') : {{ link_to_route('webhome.cattype', route('webhome.cattype', $category->name), $category->name) }}</p>
            </div>

            <div class="from-group">
            	 <div class="text-right">
            	 	<button class="btn btn-success" type="submit">Update Category</button>
            	 </div>
            </div>



      	</form>
      </div>

  </div>

@stop
