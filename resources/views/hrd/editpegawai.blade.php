<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5 pt-0">
        <div class="card p-4 shadow rounded">
            <h2 class="text-center mb-4">Edit Pegawai</h2>

            <form action="{{ route('pegawais.update', $pegawai->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{ $pegawai->nama }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <select class="form-select" id="jabatan" name="jabatan" required>
                            <option value="" disabled>Pilih Jabatan</option>
                            <option value="Manager">Manager</option>
                            <option value="Supervisor">Supervisor</option>
                            <option value="Staff">Staff</option>
                            <option value="Admin">Admin</option>
                            <option value="HRD">HRD</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $pegawai->email }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Telepon</label>
                        <input type="text" name="telp" class="form-control" value="{{ $pegawai->telp }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3" required>{{ $pegawai->alamat }}</textarea>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Masuk</label>
                            <input type="date" name="tglmasuk" class="form-control" value="{{ $pegawai->tglmasuk }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Gaji</label>
                            <input type="number" step="0.01" name="gaji" class="form-control" value="{{ $pegawai->gaji }}" required>
                        </div>
                    </div>

                    <div class="text-center pt-2 justify-content-between">
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="{{ route('pegawais.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
            </form>
        </div>
    </div>
</body>

</html>