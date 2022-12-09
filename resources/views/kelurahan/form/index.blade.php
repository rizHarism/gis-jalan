@extends('layouts.backend-dashboard.app')
@section('title', isset($edit) ? 'Edit Data Ruas Jalan' : 'Tambah Data Ruas Jalan')
@section('breadcrumb', isset($edit) ? 'Tambah Data Ruas Jalan' : 'Edit Data Ruas Jalan')
@section('content')
    @include('kelurahan.form.html2')
@endsection
@section('extra_javascript')
    @include('kelurahan.form.javascript')
@endsection