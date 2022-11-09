@extends('layouts.backend-dashboard.app')
@section('title', 'Data Penyedia Jasa')
@section('breadcrumb', 'Data Penyedia Jasa')
@section('content')
    @include('penyedia.html')
@endsection
@section('extra_javascript')
    @include('penyedia.javascript')
@endsection
