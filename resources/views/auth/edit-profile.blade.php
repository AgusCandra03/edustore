@extends('layouts.admin')
@section('header', 'Edit Profile')

@section('content')
<div id="controller">
    <div class="card">
        <div class="card-body">
            <form action="{{route('edit-profile')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name"><strong>Name</strong></label>
                    <input type="text" class="form-control" id ="name" name="name" value="{{Auth::user()->name}}">
                </div>
                <div class="form-group">
                    <label for="email"><strong>Email</strong></label>
                    <input type="text" class="form-control" id ="email" name="email" value="{{Auth::user()->email}}">
                </div>
                {{-- <div class="form-group">
                    <label for="password"><strong>Password</strong></label>
                    <input type="password" class="form-control" id ="password" name="password">
                </div>
                <div class="form-group">
                    <label for="password"><strong>Password</strong></label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div> --}}
                <button class="btn btn-primary" type="submit">Update Profile</button>
            </form>
        </div>
    </div>
    
</div>
@endsection


@section('js')
<script src="{{ asset('js/data.js') }} "></script>
@endsection