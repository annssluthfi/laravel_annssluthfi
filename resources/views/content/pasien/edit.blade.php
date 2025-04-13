@extends('layouts.app')

@section('body')
    <div>
        <div class="bg-info-subtle py-5 px-5">
            <h1 class="fw-bold">Edit Pasien</h1>
            <p>Perbarui informasi Pasien di bawah ini.</p>
            <a href="{{ route('showPasien') }}" class="btn btn-secondary mb-3">Kembali ke Daftar Pasien</a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger mx-5">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="p-5">
            <form action="{{ route('updatePasien', $pasien->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Rumah Sakit</label>
                    <input type="text" class="form-control" name="nama" id="nama"
                        value="{{ old('nama', $pasien->nama) }}" required>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" name="alamat" id="alamat"
                        value="{{ old('alamat', $pasien->alamat) }}" required>
                </div>

                <div class="mb-3">
                    <label for="telp" class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control" name="no_telp" id="no_telp"
                        value="{{ old('no_telp', $pasien->no_telp) }}" required>
                </div>

                <div class="mb-3">
                    <label for="rumah_sakit_id" class="form-label">Rumah Sakit</label>
                    <select class="form-select" name="rumah_sakit_id" id="rumah_sakit_id" required>
                        <option value="">-- Pilih Rumah Sakit --</option>
                        @foreach ($rumahSakit as $rs)
                            <option value="{{ $rs->id }}" {{ old('rumah_sakit_id', $pasien->rumah_sakit_id) == $rs->id ? 'selected' : '' }}>
                                {{ $rs->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Perbarui</button>
            </form>
        </div>
    </div>
@endsection
