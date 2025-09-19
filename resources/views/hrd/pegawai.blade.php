<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daftar Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .table th {
            background-color: #0d6efd;
            color: white;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table-rounded {
            border-radius: 5px;
            overflow: hidden;
        }
    </style>
</head>

<body>
    <div class="container-fluid mt-4 pt-2 pe-4 ps-4">
        <div class="card p-1 pe-4 ps-4">
            <h2 class="mb-4 mt-2 text-center">Daftar Pegawai</h2>

            <div class="text-center mb-3">
                <a href="{{ route('pegawais.create') }}" class="btn btn-primary">
                    Tambah Pegawai
                </a>
            </div>

            <table class="table table-striped table-hover align-middle table-rounded">
                <thead>
                    <tr class="text-center">
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Email</th>
                        <th>Telp</th>
                        <th>Alamat</th>
                        <th>Tanggal Masuk</th>
                        <th>Gaji</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pegawais as $pegawai)
                    <tr @if($pegawai->trashed()) class="table-danger" @endif>
                        <td class="text-center">{{ $pegawai->id }}</td>
                        <td>{{ $pegawai->nama }}</td>
                        <td>{{ $pegawai->jabatan }}</td>
                        <td>{{ $pegawai->email }}</td>
                        <td>{{ $pegawai->telp }}</td>
                        <td>{{ $pegawai->alamat }}</td>
                        <td class="text-center">{{ $pegawai->tglmasuk }}</td>
                        <td class="text-center">Rp {{ number_format($pegawai->gaji, 0, ',', '.') }}</td>
                        <!-- <td class="text-center">
                            <a href="{{ route('pegawais.edit', $pegawai->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('pegawais.destroy', $pegawai->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus pegawai ini?')">Hapus</button>
                            </form>
                        </td> -->
                        <td>
                            @if(!$pegawai->trashed())
                            <a href="{{ route('pegawais.edit', $pegawai->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('pegawais.destroy', $pegawai->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus pegawai ini?')">Hapus</button>
                            </form>
                            @else

                            <a href="{{ route('pegawais.restore', $pegawai->id) }}" class="btn btn-sm btn-success">Restore</a>

                            <form action="{{ route('pegawais.forceDelete', $pegawai->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-dark">Hapus</button>
                            </form>
                            @endif
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>