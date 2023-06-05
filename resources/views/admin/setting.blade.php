@extends('layouts.admin')
@section('header', 'Setting')

@section('content')
<div id="controller">
    <div class="card">
      <div class="card-body">        
        <form action="{{ route('settings') }} " method="POST">
          @csrf
          <div class="form-group">
              <label for="name"><strong>Name</strong></label>
              <input type="text" class="form-control" id ="name" name="name" value="{{ $setting->name }}">
          </div>
          <div class="form-group">
              <label for="address"><strong>Address</strong></label>
              <input type="text" class="form-control" id ="address" name="address" value="{{ $setting->address }} ">
          </div>
          <div class="form-group">
            <label for="phone_number"><strong>Phone Number</strong></label>
            <input type="text" class="form-control" id ="phone_number" name="phone_number" value="{{ $setting->phone_number }} ">
        </div>
  
          <button class="btn btn-primary" type="submit">Save</button>
        </form>
      </div>
    </div>
</div>
@endsection


@section('js')
@endsection