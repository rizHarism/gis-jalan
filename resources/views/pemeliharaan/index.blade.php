@extends('layouts.backend-dashboard.app')
@section('title', 'Data Pemeliharaan')
@section('breadcrumb', 'Data Pemeliharaan')
@section('content')
    @include('pemeliharaan.html')
@endsection
@section('extra_javascript')
    @include('pemeliharaan.javascript')
@endsection
