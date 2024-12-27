@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <h1>404 - Halaman Tidak Ditemukan</h1>
        <p>Maaf, halaman yang Anda cari tidak dapat ditemukan.</p>
        <a href="{{ route('home') }}" class="btn btn-primary">Kembali ke Halaman Utama</a>
    </div>
@endsection
