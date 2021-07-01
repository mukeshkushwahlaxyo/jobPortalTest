@extends('admin.layouts.master')

@section('content')
  @if(!$product->has_variant)
    {!! Form::open(['route' => 'admin.stock.inventory.store', 'files' => true, 'id' => 'form-ajax-upload', 'data-toggle' => 'validator']) !!}
  @endif  

        @include('admin.inventory._form')

  {{-- @if(!$product->has_variant) --}}
    {!! Form::close() !!}
  {{-- @endif   --}}
@endsection

@section('page-script')
    @include('plugins.dropzone-upload')
    @include('plugins.dynamic-inputs')
@endsection