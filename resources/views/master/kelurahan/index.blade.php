@extends('layouts.backend-dashboard.app')
@section('title', 'Master Data Kelurahan')
@section('breadcrumb', 'Master Data Kelurahan')
@section('content')
    @include('master.kelurahan.html')
@endsection
@section('extra_javascript')
    @include('master.kelurahan.javascript')
@endsection
