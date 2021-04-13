@extends('layouts.theme-backend')

@section('title', 'Add Images')
@section('title-bread', 'Add Images')

@section('content')
   <div class="row">
      <div class="col-md-4">
         @include('admin.products.menus')
      </div>
      <div class="col-md-8">
         <div class="card card-default">
            <div class="card-header"><h6>Upload Image</h6></div>
            <div class="card-body">
               @include('admin.partials.flash', ['errors' => $errors])
               {!! Form::open(['url' => ['admin/products/images', $product->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
               <div class="form-group">
                  {!! Form::label('image', 'Product Image') !!}
                  {!! Form::file('image', ['class' => 'form-control-file', 'placeholder' => 'product image']) !!}
               </div>
               <div class="form-footer pt-5 border-top-0">
                  <button type="submit" class="btn btn-primary">Save</button>
                  <a href="{{ url('admin/products/'. $productID .'/images') }}"></a>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection