@extends('layouts.admin')
@section('header', 'Dashboard')

@section('content')
<div class="container">
        <div class="row">
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-info">
                    <div class="inner">
                      <h3>{{ $total_product }} </h3>
      
                      <p>Products</p>
                    </div>
                    <div class="icon">
                      <i class="nav-icon fas fa-th"></i>
                    </div>
                    <a href="{{ url('products') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-success">
                    <div class="inner">
                      <h3>{{ $total_supplier }}  </h3>
      
                      <p>Suppliers</p>
                    </div>
                    <div class="icon">
                      <i class="nav-icon fas fa-truck"></i>
                    </div>
                    <a href="{{ url('suppliers') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-warning">
                    <div class="inner">
                      <h3>{{ $total_member }} </h3>
      
                      <p>Members</p>
                    </div>
                    <div class="icon">
                      <i class="nav-icon fas fa-users"></i>
                    </div>
                    <a href="{{ url('members') }} " class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-danger">
                    <div class="inner">
                      <h3>{{ $total_user }}</h3>
      
                      <p>User</p>
                    </div>
                    <div class="icon">
                      <i class="nav-icon fas fa-user"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
              </div>
</div>
@endsection
