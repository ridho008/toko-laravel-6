@extends('layouts.theme-backend')

@section('title-bread', 'Category')
@section('content')
<div class="row">
   <div class="col-md-6">
      <a href="{{ url('admin/categories/create') }}" class="btn btn-primary mb-2">Add New Category</a>
   </div>
   <div class="col-md-6">
      <form action="/admin/category" method="get">
         <div class="input-group mb-3">
           <input type="text" class="form-control" name="keyword" value="{{ old('keyword') }}" placeholder="Search..." autocomplete="off" autofocus="on">
           <div class="input-group-append">
             <button type="submit" class="btn btn-outline-secondary" id="button-addon2">Search</button>
           </div>
         </div>
      </form>
   </div>
</div>
<div class="table-responsive">
   <table class="table table-bordered table-striped">
      <thead>
         <tr>
            <th>No</th>
            <th>Category</th>
            <th>Slug</th>
            <th>Parend ID</th>
            <th>Action</th>
         </tr>
      </thead>
      <tbody>
         @forelse($categories as $key => $category)
            <tr>
               <td>{{ $key + $categories->firstitem() }}</td>
               <td>{{ $category->name }}</td>
               <td>{{ $category->slug }}</td>
               <td>{{ $category->parent ? $category->parent->name : '' }}</td>
               <td>
                  <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info btn-xs">Edit</a>
                  {!! Form::open(['url' => 'admin/categories/'.$category->id, 'class' => 'delete', 'style' => 'display:inline-block']) !!}
                  {!! Form::hidden('_method', 'DELETE') !!}
                  {!! Form::submit('remove', ['class' => 'btn btn-danger btn-xs']) !!}
                  {!! Form::close() !!}
               </td>
               @empty
               <td colspan="2">
                  <small class="text-center text-danger">Data Null</small>
               </td>
            </tr>
         @endforelse
      </tbody>
   </table>
   <div class="row">
      <div class="col-md-12">
         {{ $categories->links() }}
         <div class="row">
            <div class="col-md-6">
               <table class="table">
                  <tr>
                     <th>Halaman : </th>
                     <td>{{ $categories->currentPage() }}</td>
                  </tr>
                  <tr>
                     <th>Jumlah Data : </th>
                     <td>{{ $categories->total() }}</td>
                  </tr>
                  <tr>
                     <th>Data Per Halaman : </th>
                     <td>{{ $categories->perPage() }}</td>
                  </tr>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Add New Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <form action="" method="post">
                  @csrf
                  @method('put')
                  <div class="form-group">
                     <label for="name">Name</label>
                     <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                     @error('name')
                     <small class="muted text-danger">{{ $message }}</small>
                     @enderror
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-primary">Save</button>
                  </div>
               </form>
            </div>
        </div>
    </div>
</div>

@endsection