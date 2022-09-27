@extends('layouts.backend-dashboard.app')
@section('title', 'Data Desa')
@section('breadcrumb', 'Data Desa')
@section('content')
    @include('desa.html')
@endsection
@section('extra_javascript')
    @include('desa.javascript')
@endsection
