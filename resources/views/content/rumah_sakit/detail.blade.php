@extends('layouts.app')

@section('body')
    <div>
        <div class="bg-info-subtle py-5 px-5">
            <h1 class="fw-bold">Detail Rumah Sakit</h1>
            <p>Berikut adalah informasi detail rumah sakit dan daftar pasien yang terdaftar.</p>
            <a href="{{ route('showRumahSakit') }}" class="btn btn-secondary mb-3">Kembali ke Daftar Rumah Sakit</a>
        </div>

        <div class="container py-4">
            <div class="card">
                <div class="card-header">
                    <h3>{{ $rumahSakit->nama }}</h3>
                    <p>{{ $rumahSakit->alamat }}</p>
                    <p><strong>Email:</strong> {{ $rumahSakit->email }}</p>
                    <p><strong>Telepon:</strong> {{ $rumahSakit->telp }}</p>
                </div>
                <div class="card-body">
                    <h4>Daftar Pasien</h4>
                    @if($rumahSakit->pasien->isEmpty())
                        <p>Tidak ada pasien terdaftar di rumah sakit ini.</p>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pasien</th>
                                    <th>Alamat</th>
                                    <th>No Telp</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rumahSakit->pasien as $pasien)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pasien->nama }}</td>
                                        <td>{{ $pasien->alamat }}</td>
                                        <td>{{ $pasien->no_telp }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
