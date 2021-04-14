@extends('layouts.theme-backend')

@section('title', 'Form Options')
@section('title-bread', 'Form Options')

@section('content')
<div class="row">
  <div class="col-md-5">
    @include('admin.attributes.option_form')
  </div>
   <div class="col-md-7">
      <div class="card">
         <div class="card-header card-header-border-bottom"><h3>Options for : {{ $attribute->name }}</h3></div>
         <div class="card-body">
           <table class="table table-reponsive table-bordered table-striped">
             <thead>
               <tr>
                 <th>#</th>
                 <th>Name</th>
                 <th>Action</th>
               </tr>
             </thead>
             <tbody>
               @forelse($attribute->attributeOptions as $option)
                  <tr>
                    <td>{{ $option->id }}</td>
                    <td>{{ $option->name }}</td>
                    <td>
                      <a href="{{ url('admin/attributes/options/' . $option->id. '/edit') }}" class="btn btn-xs btn-info">Edit</a>
                      {!! Form::open(['url' => 'admin/attributes/options/'.$option->id, 'class' => 'delete', 'style' => 'display:inline-block']) !!}
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
@endsection