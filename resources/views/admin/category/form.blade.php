@extends('layouts.theme-backend')

@if(!empty($category))
@section('title-bread', 'Edit Category')
@else
@section('title-bread', 'Add Category')
@endif

@section('content')

@php
   $formTitle = !empty($category) ? 'Update' : 'New'
@endphp

{{-- Menggunakan https://laravelcollective.com/docs/6.x/html --}}

<div class="row">
   <div class="col-md-6">
      <div class="card">
         <div class="card-header"><h6>{{ $formTitle }} Category</h6></div>
         <div class="card-body">
            @include('admin.partials.flash', ['errors' => $errors])
            {{-- jika kategorinya tidak kosong, jalankan aksi edit --}}
            @if(!empty($category))
               {!! Form::model($category, ['url' => ['admin/categories', $category->id], 'method' => 'PUT']) !!}
               {!! Form::hidden('id') !!}
            @else
            {{-- jika inputan kategorinya kosong, jalankan aksi tambah --}}
               {!! Form::open(['url' => 'admin/categories']) !!}
            @endif
               <div class="form-group">
                  {!! Form::label('name', 'Name') !!}
                  {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'category name']) !!}
               </div>
               <div class="form-footer pt-5">
                  <button type="submit" class="btn btn-primary">Save</button>
               </div>
            {!! Form::close() !!}
         </div>
      </div>
   </div>
</div>

@endsection