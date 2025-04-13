@extends('layouts.app')

@section('body')
    <div>
        <div class="bg-info-subtle py-5 px-5">
            <h1 class="fw-bold">Tambah Pasien</h1>
            <p>Isi formulir di bawah ini untuk menambahkan Pasien ke sistem informasi.</p>
            <a href="{{ route('showPasien') }}" class="btn btn-secondary mb-3">Kembali ke Daftar Pasien</a>
        </div>
       @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <div class="px-5 py-4">
            <form action="{{ route('storePasien') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Pasien</label>
                    <input type="text" class="form-control" name="nama" id="nama" value="{{ old('nama') }}" required>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" name="alamat" id="alamat" value="{{ old('alamat') }}" required>
                </div>


                <div class="mb-3">
                    <label for="telp" class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control" name="no_telp" id="no_telp" value="{{ old('no_telp') }}" required>
                </div>

                <div class="mb-3">
                    <label for="rumah_sakit_id" class="form-label">Rumah Sakit</label>
                    <select class="form-select" name="rumah_sakit_id" id="rumah_sakit_id" required>
                        <option value="">-- Pilih Rumah Sakit --</option>
                        @foreach ($rumahSakit as $rs)
                            <option value="{{ $rs->id }}" {{ old('rumah_sakit_id') == $rs->id ? 'selected' : '' }}>
                                {{ $rs->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>            
        </div>
    </div>
@endsection