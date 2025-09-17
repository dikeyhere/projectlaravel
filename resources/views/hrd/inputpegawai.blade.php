<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 40px;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card p-4">
            <h2 class="mb-5 text-center">Tambah Pegawai</h2>

            <form action="{{ route('pegawais.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>

                    <div class="col-md-6">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <select class="form-select" id="jabatan" name="jabatan" required>
                            <option value="" disabled selected>Pilih Jabatan</option>
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
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="col-md-6">
                        <label for="telp" class="form-label">Telepon</label>
                        <input type="text" class="form-control" id="telp" name="telp" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <input type="text" name="alamat" class="form-control" required>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Masuk</label>
                        <input type="date" name="tglmasuk" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Gaji</label>
                        <input type="number" step="0.01" name="gaji" class="form-control" required>
                    </div>
                </div>

                <div class="text-center pt-2">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{ route('pegawais.index') }}" class="btn btn-secondary">Kembali</a>
                </div>

            </form>
        </div>
    </div>
</body>

</html>