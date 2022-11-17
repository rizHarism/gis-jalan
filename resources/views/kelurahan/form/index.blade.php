@extends('layouts.backend-dashboard.app')
@section('title', isset($edit) ? 'Tambah Data Ruas Jalan' : 'Edit Data Ruas Jalan')
@section('breadcrumb', isset($edit) ? 'Tambah Data Ruas Jalan' : 'Edit Data Ruas Jalan')
@section('content')
    @include('kelurahan.form.html')
@endsection
@section('extra_javascript')
    @include('kelurahan.form.javascript')
@endsection
