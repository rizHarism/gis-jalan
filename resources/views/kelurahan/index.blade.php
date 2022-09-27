@extends('layouts.backend-dashboard.app')
@section('title', 'Data Kelurahan')
@section('breadcrumb', 'Data Kelurahan')
@section('content')
    @include('kelurahan.html')
@endsection
@section('extra_javascript')
    @include('kelurahan.javascript')
@endsection
