@extends('layouts.app')

@section('body')
    <div>
        <div class="bg-info-subtle py-5 px-5">
            <h1 class="fw-bold">Daftar Pasien</h1>
            <p>Berikut adalah daftar pasien yang terdaftar di rumah sakit.</p>
            <a href="{{ route('createPasien') }}" class="btn btn-primary mt-2 fw-semibold">Tambah Pasien</a>
        </div>

        <div class="container py-4">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="mb-3">
                <label for="filterRumahSakit" class="form-label">Filter berdasarkan Rumah Sakit</label>
                <select class="form-select" id="filterRumahSakit">
                    <option value="">-- Semua Rumah Sakit --</option>
                    @foreach ($rumahSakit as $rs)
                        <option value="{{ $rs->id }}">{{ $rs->nama }}</option>
                    @endforeach
                </select>
            </div>

            <table class="table border rounded overflow-hidden">
                <thead class="bg-light border-bottom">
                    <tr>
                        <th>No</th>
                        <th>Nama Pasien</th>
                        <th>Alamat</th>
                        <th>Rumah Sakit</th>
                        <th>No Telp</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="pasienList">
                    @foreach ($pasien as $p)
                        <tr id="row-{{ $p->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->alamat }}</td>
                            <td>{{ $p->no_telp }}</td>
                            <td>{{ $p->rumahSakit->nama }}</td>
                            <td>
                                <a href="{{ route('detailPasien', $p->id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-info-circle"></i> Detail
                                </a>
                                <a href="{{ route('editPasien', $p->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $p->id }}">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        //hapus data pasien
        $(document).ready(function () {
            $('.btn-delete').click(function () {
                let id = $(this).data('id');
                if (confirm('Yakin ingin menghapus data ini?')) {
                    $.ajax({
                        url: '/pasien/' + id,
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

        //filter data pasien berdasarkan rumah sakit
        $(document).ready(function () {
                $('#filterRumahSakit').change(function () {
                    const rumahSakitId = $(this).val();

                    $.ajax({
                        url: '{{ route('filterPasien') }}',
                        type: 'GET',
                        data: {
                            rumah_sakit_id: rumahSakitId
                        },
                        success: function (data) {
                            let html = '';
                            data.forEach((p, index) => {
                                html += `
                            <tr id="row-${p.id}">
                                <td>${index + 1}</td>
                                <td>${p.nama}</td>
                                <td>${p.alamat}</td>
                                <td>${p.no_telp}</td>
                                <td>${p.rumah_sakit.nama}</td>
                                <td>
                                    <a href="/pasien/${p.id}" class="btn btn-sm btn-info">
                                        <i class="bi bi-info-circle"></i> Detail
                                    </a>
                                    <a href="/pasien/${p.id}/edit" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <button class="btn btn-sm btn-danger btn-delete" data-id="${p.id}">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                        `;
                            });

                            $('#pasienList').html(html);
                        },
                        error: function () {
                            alert('Gagal memuat data pasien.');
                        }
                    });
                });
            });
    </script>
@endpush