@extends('layouts.admin')

@section('title')

  Admin Area

@endsection


@section('nav')

  <!-- Navigation -->
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      @include('admin.partials.topNav')
      @include('admin.partials.sideNav') 
  </nav>

@endsection




@section('content')

  @if(request()->is('adminarea'))

    @include('admin.partials.index')
  
  @endif

  @if(request()->is('adminarea/orders'))

    @include('admin.orders')
  
  @endif

  @if(request()->is('adminarea/products'))

    @include('admin.products')
  
  @endif

  @if(request()->is('adminarea/add-product'))

    @include('admin.addProduct')
  
  @endif

  @if(request()->is('adminarea/edit-product/*'))

    @include('admin.editProduct')
  
  @endif

  @if(request()->is('adminarea/categories'))

    @include('admin.categories')
  
  @endif

  @if(request()->is('adminarea/users'))

    @include('admin.users')
  
  @endif

  @if(request()->is('adminarea/add-user'))
  
    @include('admin.addUser')
  
  @endif

  @if(request()->is('adminarea/edit-user/*'))

    @include('admin.editUser')
  
  @endif

@endsection