@extends('layouts.app')

@section('body')
    <div>
        <div class="bg-info-subtle py-5 px-5">
            <h1 class="fw-bold">Tambah Rumah Sakit</h1>
            <p>Isi formulir di bawah ini untuk menambahkan Rumah Sakit ke sistem informasi.</p>
            <a href="{{ route('showRumahSakit') }}" class="btn btn-secondary mb-3">Kembali ke Daftar Rumah Sakit</a>
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

        <div class="p-5">
            <form action="{{ route('storeRumahSakit') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Rumah Sakit</label>
                    <input type="text" class="form-control" name="nama" id="nama" value="{{ old('nama') }}" required>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" name="alamat" id="alamat" value="{{ old('alamat') }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label for="telp" class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control" name="telp" id="telp" value="{{ old('telp') }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>            
        </div>
    </div>
@endsection