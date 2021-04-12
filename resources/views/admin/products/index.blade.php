@extends('layouts.theme-backend')

@section('title', 'Products')
@section('title-bread', 'All Products')
@section('content')
<div class="row">
   <div class="col-md-6">
      <a href="{{ route('products.create') }}" class="btn btn-primary mb-2">Add New Product</a>
   </div>
   <div class="col-md-12">
      <div class="card">
         <div class="card-body">
            <div class="table-responsive">
               <table class="table table-bordered table-striped">
                  <thead>
                     <tr>
                        <th>No</th>
                        <th>SKU</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($products as $key => $product)
                     <tr>
                        <td>{{ $key + $products->firstitem() }}</td>
                        <td>{{ $product->sku }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->status }}</td>
                        <td>
                           <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info btn-xs">Edit</a>
                           {!! Form::open(['url' => 'admin/products/'.$product->id, 'class' => 'delete', 'style' => 'display:inline-block']) !!}
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
               <div class="row">
                  <div class="col-md-12">
                     {{ $products->links() }}
                     <div class="row">
                        <div class="col-md-6">
                           <table class="table">
                              <tr>
                                 <th>Halaman : </th>
                                 <td>{{ $products->currentPage() }}</td>
                              </tr>
                              <tr>
                                 <th>Jumlah Data : </th>
                                 <td>{{ $products->total() }}</td>
                              </tr>
                              <tr>
                                 <th>Data Per Halaman : </th>
                                 <td>{{ $products->perPage() }}</td>
                              </tr>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection