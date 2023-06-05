@extends('layouts.admin')
@section('header', 'Sales')
@section('cs')
@endsection

@section('content')
    <!-- Sale Add -->
    <sale-add></sale-add>
    <!-- Sale Add -->
@endsection

@section('js')
    <!-- Select2 -->
    <script src="{{ mix('js/app.js') }}"></script>
@endsection
