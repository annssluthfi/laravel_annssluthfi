@extends('layouts.app')

@section('body')
    <div>
        <div class="bg-info-subtle py-5 px-5">
            <h1 class="fw-bold">Detail Pasien</h1>
            <p>Berikut adalah informasi detail pasien yang terdaftar.</p>
            <a href="{{ route('showPasien') }}" class="btn btn-secondary mb-3">Kembali ke Daftar Pasien</a>
        </div>

        <div class="container py-4">
            <div class="card">
                <div class="card-header">
                    <h3>{{ $pasien->nama }}</h3>
                    <p><strong>Alamat:</strong> {{ $pasien->alamat }}</p>
                    <p><strong>Telepon:</strong> {{ $pasien->no_telp }}</p>
                    <p><strong>Rumah Sakit:</strong> {{ $pasien->rumahSakit->nama }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
