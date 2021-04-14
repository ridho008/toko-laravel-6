@extends('layouts.theme-backend')

@section('title', 'Attributes')
@section('title-bread', 'Attributes')
@section('content')
<div class="row">
   <div class="col-md-6">
      <a href="{{ route('attributes.create') }}" class="btn btn-primary mb-2">Add New Category</a>
   </div>
   {{-- <div class="col-md-6">
      <form action="/admin/category" method="get">
         <div class="input-group mb-3">
           <input type="text" class="form-control" name="keyword" value="{{ old('keyword') }}" placeholder="Search..." autocomplete="off" autofocus="on">
           <div class="input-group-append">
             <button type="submit" class="btn btn-outline-secondary" id="button-addon2">Search</button>
           </div>
         </div>
      </form>
   </div> --}}
</div>
<div class="table-responsive">
   <table class="table table-bordered table-striped">
      <thead>
         <tr>
            <th>No</th>
            <th>Code</th>
            <th>Name</th>
            <th>Type</th>
            <th>Action</th>
         </tr>
      </thead>
      <tbody>
         @forelse($attributes as $key => $attribute)
            <tr>
               <td>{{ $key + $attributes->firstitem() }}</td>
               <td>{{ $attribute->code }}</td>
               <td>{{ $attribute->name }}</td>
               <td>{{ $attribute->type }}</td>
               <td>
                  <a href="{{ route('attributes.edit', $attribute->id) }}" class="btn btn-info btn-xs">Edit</a>
                  {!! Form::open(['url' => 'admin/attributes/'.$attribute->id, 'class' => 'delete', 'style' => 'display:inline-block']) !!}
                  {!! Form::hidden('_method', 'DELETE') !!}
                  {!! Form::submit('remove', ['class' => 'btn btn-danger btn-xs']) !!}
                  {!! Form::close() !!}
               </td>
               @empty
               <tr>
                  <td colspan="6" class="text-center">
                     <small class="text-danger">Data Null</small>
                  </td>
               </tr>
            </tr>
         @endforelse
      </tbody>
   </table>
   <div class="row">
      <div class="col-md-12">
         {{ $attributes->links() }}
         <div class="row">
            <div class="col-md-6">
               <table class="table">
                  <tr>
                    <div class="row">
                      <div class="col-md-4">
                        <th>Halaman : </th>
                        <td>{{ $attributes->currentPage() }}</td>
                      </div>
                      <div class="col-md-4">
                        <th>Jumlah Data : </th>
                        <td>{{ $attributes->total() }}</td>
                      </div>
                      <div class="col-md-4">
                        <th>Data Per Halaman : </th>
                        <td>{{ $attributes->perPage() }}</td>
                      </div>
                    </div>
                     
                     
                     
                  </tr>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection