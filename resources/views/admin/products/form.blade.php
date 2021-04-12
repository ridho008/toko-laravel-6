@extends('layouts.theme-backend')

@section('title', 'Add New Product')
@section('title-bread', 'Add New Product')

@php
   $formTitle = !empty($product) ? 'Update' : 'New'
@endphp

@section('content')
<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-header"><h6>{{ $formTitle }} Category</h6></div>
         <div class="card-body">
             @include('admin.partials.flash', ['errors' => $errors])
            @if(!empty($product))
               {!! Form::model($product, ['url' => ['admin/products', $product->id], 'method' => 'PUT']) !!}
            {!! Form::hidden('id') !!}
            @else
               {!! Form::open(['url' => 'admin/products']) !!}
            @endif
               <div class="form-group">
                  {!! Form::label('sku', 'SKU') !!}
                  {!! Form::text('sku', null, ['class' => 'form-control', 'placeholder' => 'sku']) !!}
               </div>
               <div class="form-group">
                  {!! Form::label('name', 'Name') !!}
                  {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'name']) !!}
               </div>
               <div class="form-group">
                  {!! Form::label('price', 'Price') !!}
                  {!! Form::text('price', null, ['class' => 'form-control', 'placeholder' => 'price']) !!}
               </div>
               <div class="form-group">
                   {!! Form::label('category_ids', 'Category') !!}
                   {!! General::selectMultiLevel('category_ids[]', $categories, ['class' => 'form-control', 'multiple' => true, 'selected' => !empty(old('category_ids')) ? old('category_ids') : $categoryIDs, 'placeholder' => '-- Choose Category --']) !!}
               </div>
               <div class="form-group">
                  {!! Form::label('short_description', 'Short Description') !!}
                  {!! Form::text('short_description', null, ['class' => 'form-control', 'placeholder' => 'short_description']) !!}
               </div>
               <div class="form-group">
                    {!! Form::label('description', 'Description') !!}
                    {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'description']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('weight', 'Weight') !!}
                    {!! Form::text('weight', null, ['class' => 'form-control', 'placeholder' => 'weight']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('length', 'Length') !!}
                    {!! Form::text('length', null, ['class' => 'form-control', 'placeholder' => 'length']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('width', 'Width') !!}
                    {!! Form::text('width', null, ['class' => 'form-control', 'placeholder' => 'width']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('height', 'Height') !!}
                    {!! Form::text('height', null, ['class' => 'form-control', 'placeholder' => 'height']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('status', 'Status') !!}
                    {!! Form::select('status', $statuses , null, ['class' => 'form-control', 'placeholder' => '-- Set Status --']) !!}
                </div>
                <div class="form-footer pt-5 border-top">
                   <button type="submit" class="btn btn-primary btn-default">Save</button>
                   <a href="{{ url('admin/products') }}" class="btn btn-secondary btn-default">Back</a>
               </div>
            {!! Form::close() !!}
         </div>
      </div>
   </div>
</div>
@endsection