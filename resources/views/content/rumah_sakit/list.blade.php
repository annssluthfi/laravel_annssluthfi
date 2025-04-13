@extends('layouts.app')

@section('body')
    <div>
        <div class="bg-info-subtle py-5 px-5">
            <h1 class="fw-bold">Daftar Rumah Sakit</h1>
            <p>Berikut adalah daftar rumah sakit yang terdata pada sistem informasi.</p>
            <a href="{{ route('createRumahSakit') }}" class="btn btn-primary mt-2 fw-semibold">Tambah Rumah Sakit</a>
        </div>

        <div class="container py-4">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif            
            <table class="table border rounded overflow-hidden">
                <thead class="bg-light border-bottom">
                    <tr>
                        <th>No</th>
                        <th>Nama Rumah Sakit</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>No Telp</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @forelse ($rumahSakit as $rs)
                        <tr id="row-{{ $rs->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $rs->nama }}</td>
                            <td>{{ $rs->alamat }}</td>
                            <td>{{ $rs->email }}</td>
                            <td>{{ $rs->telp }}</td>
                            <td>
                                <a href="{{ route('detailRumahSakit', $rs->id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-info-circle"></i> Detail
                                </a>
                                <a href="{{ route('editRumahSakit', $rs->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $rs->id }}">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    //hapus data rumah sakit
    $(document).ready(function () {
        $('.btn-delete').click(function () {
            let id = $(this).data('id');
            if (confirm('Yakin ingin menghapus data ini?')) {
                $.ajax({
                    url: '/rumah-sakit/' + id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if (response.success) {
                            $('#row-' + id).fadeOut();
                        }
                    },
                    error: function () {
                        alert('Gagal menghapus data.');
                    }
                });
            }
        });
    });
</script>
@endpush