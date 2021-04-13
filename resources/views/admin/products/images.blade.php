@extends('layouts.theme-backend')

@section('title', 'Add Images')
@section('title-bread', 'Add Images')

@section('content')
   <div class="row">
      <div class="col-md-4">
         @include('admin.products.menus')
      </div>
      <div class="col-md-8">
         <div class="card">
            <div class="card-body">
               @include('admin.partials.flash')
               <a href="{{ url('admin/products/'. $productID .'/add_image') }}" class="btn btn-primary btn-xs">Add New Image</a>
               <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                     <thead>
                        <tr>
                           <th>#</th>
                           <th>Image</th>
                           <th>Uploaded At</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @forelse($productImages as $key => $image)
                        <tr>
                           <td>1</td>
                           <td>
                              <img src="{{ asset('storage/'.$image->path) }}" class="img-fluid" width="150px">
                           </td>
                           <td>{{ $image->created_at }}</td>
                           <td>
                              {!! Form::open(['url' => 'admin/products/images/'.$image->id, 'class' => 'delete', 'style' => 'display:inline-block']) !!}
                              {!! Form::hidden('_method', 'DELETE') !!}
                              {!! Form::submit('remove', ['class' => 'btn btn-danger btn-xs']) !!}
                              {!! Form::close() !!}
                           </td>
                        </tr>
                        @empty
                        <tr>
                           <td colspan="6" class="text-center">
                              <small class="text-danger">Data Null</small>
                           </td>
                        </tr>
                        @endforelse
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection