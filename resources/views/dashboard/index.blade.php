@extends('layouts.backend-dashboard.app')
@section('title', 'Dashboard')
@section('breadcrumb', 'Dashboard')
@section('content')
    @include('dashboard.html')
@endsection
@section('extra_javascript')
    @include('dashboard.javascript')
@endsection
