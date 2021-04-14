@extends('layouts.theme-backend')

@if(!empty($attribute))
@section('title', 'Edit Attribute')
@section('title-bread', 'Edit Attribute')
@else
@section('title', 'Add New Attribute')
@section('title-bread', 'Add New Attribute')
@endif

@php
   $formTitle = !empty($attribute) ? 'Update' : 'New';
   $disableInput = !empty($attribute) ? true : false;
@endphp

@section('content')
<div class="row">
   <div class="col-md-8">
      <div class="card">
         <div class="card-header"><h6>{{ $formTitle }} Attribute</h6></div>
         <div class="card-body">
             @include('admin.partials.flash', ['errors' => $errors])
            @if(!empty($attribute))
               {!! Form::model($attribute, ['url' => ['admin/attributes', $attribute->id], 'method' => 'PUT']) !!}
            {!! Form::hidden('id') !!}
            @else
               {!! Form::open(['url' => 'admin/attributes']) !!}
            @endif
              <fieldset class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <legend class="col-form-label pt-0 text-secondary">General</legend>
                     <div class="form-group">
                        {!! Form::label('code', 'Code') !!}
                        {!! Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'code', 'readonly' => $disableInput]) !!}
                     </div>
                     <div class="form-group">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'name']) !!}
                     </div>
                     <div class="form-group">
                       {!! Form::label('type', 'Type') !!}
                       {!! Form::select('type', $types , null, ['class' => 'form-control', 'placeholder' => '-- Set Type --', 'readonly' => $disableInput]) !!}
                     </div>
                  </div>
                </div>
              </fieldset>
              <fieldset class="form-group">
                <div class="row">
                    <div class="col-lg-12">
                        <legend class="col-form-label pt-0 text-secondary">Validation</legend>
                        <div class="form-group">
                                {!! Form::label('is_required', 'Is Required?') !!}
                                {!! Form::select('is_required', $booleanOptions , null, ['class' => 'form-control', 'placeholder' => '']) !!}
                        </div>
                        <div class="form-group">
                                {!! Form::label('is_unique', 'Is Unique?') !!}
                                {!! Form::select('is_unique', $booleanOptions , null, ['class' => 'form-control', 'placeholder' => '']) !!}
                        </div>
                        <div class="form-group">
                                {!! Form::label('validation', 'Validation') !!}
                                {!! Form::select('validation', $validations , null, ['class' => 'form-control', 'placeholder' => '']) !!}
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset class="form-group">
              <div class="row">
                  <div class="col-lg-12">
                      <legend class="col-form-label pt-0 text-secondary">Configuration</legend>
                      <div class="form-group">
                              {!! Form::label('is_configurable', 'Use in Configurable Product?') !!}
                              {!! Form::select('is_configurable', $booleanOptions , null, ['class' => 'form-control', 'placeholder' => '']) !!}
                      </div>
                      <div class="form-group">
                              {!! Form::label('is_filterable', 'Use in Filtering Product?') !!}
                              {!! Form::select('is_filterable', $booleanOptions , null, ['class' => 'form-control', 'placeholder' => '']) !!}
                      </div>
                  </div>
              </div>
            </fieldset>
            <div class="form-footer pt-5 border-top">
               <button type="submit" class="btn btn-primary btn-default">Save</button>
               <a href="{{ route('attributes.index') }}" class="btn btn-secondary btn-default">Back</a>
           </div>
            {!! Form::close() !!}
         </div>
      </div>
   </div>
</div>
@endsection