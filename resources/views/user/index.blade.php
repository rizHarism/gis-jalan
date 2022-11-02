@extends('layouts.backend-dashboard.app')
@section('title', 'Data Pengguna')
@section('breadcrumb', 'Data Pengguna')
@section('content')
    @include('user.html')
@endsection
@section('extra_javascript')
    @include('user.javascript')
@endsection
