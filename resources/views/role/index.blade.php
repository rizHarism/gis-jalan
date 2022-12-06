@extends('layouts.backend-dashboard.app')
@section('title', 'Data Role')
@section('breadcrumb', 'Data Role')
@section('content')
    @include('role.html')
@endsection
@section('extra_javascript')
    @include('role.javascript')
@endsection
