@extends('layouts.backend-dashboard.app')
@section('title', 'Master Data Kecamatan')
@section('breadcrumb', 'Master Data Kecamatan')
@section('content')
    @include('master.kecamatan.html')
@endsection
@section('extra_javascript')
    @include('master.kecamatan.javascript')
@endsection
