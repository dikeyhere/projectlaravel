@extends('layouts.app')

@section('content')
<style>
    .bg-email {
        background-color: #f0f0f0ff !important;
    }

    input:disabled,
    textarea:disabled,
    select:disabled {
        background-color: #f0f0f0ff !important;
    }
</style>

<div class="container mt-3 mb-5">
    <h1>Profile</h1>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="text-center mb-4">
        @if($user->profile_photo)
        <img src="{{ asset('storage/' . $user->profile_photo) }}"
            alt="Profile Photo"
            class="rounded-circle"
            width="150" height="150">
        @else
        <img src="{{ asset('images/default.png') }}"
            alt="Default Photo"
            class="rounded-circle"
            width="150" height="150">
        @endif
    </div>

    <form id="profileForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="mb-4">
        @csrf
        <div class="mb-3 d-none" id="fotoWrapper">
            <label for="foto" class="form-label">Foto Profil</label>
            <input type="file" name="foto" id="fotoInput" class="form-control" accept="image/*" disabled>
        </div>
        <div class="row mb-3 mt-3">
            <div class="col">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control bg-email" value="{{ $user->email }}" readonly>
            </div>
            <div class="col">
                <label for="name" class="form-label">Nama</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" readonly required disabled>
                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="jabatan" class="form-label">Jabatan</label>
                <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan', $user->jabatan) }}" readonly>
                @error('jabatan') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col">
                <label for="telp" class="form-label">No Telepon</label>
                <input type="text" name="telp" class="form-control" value="{{ old('telp', $user->telp) }}" readonly>
                @error('telp') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control mb-2" readonly>{{ old('alamat', $user->alamat) }}</textarea>
            @error('alamat') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3 pt-3">
            <button type="button" id="editBtn" class="btn btn-secondary">Edit Profile</button>
            <button type="submit" id="saveBtn" class="btn btn-primary d-none">Simpan Perubahan</button>
            <button type="button" id="cancelBtn" class="btn btn-danger d-none">Batal</button>
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#resetPasswordModal">
                Reset Password
            </button>
        </div>
    </form>

    <div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resetPasswordModalLabel">Reset Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Password Lama</label>
                            <input type="password" name="old_password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Password Baru</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Reset Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const editBtn = document.getElementById("editBtn");
        const saveBtn = document.getElementById("saveBtn");
        const cancelBtn = document.getElementById("cancelBtn");
        const inputs = document.querySelectorAll("#profileForm input, #profileForm textarea");

        let initialValues = {};
        inputs.forEach(el => {
            if (el.name) initialValues[el.name] = el.value;
        });

        cancelBtn.addEventListener("click", () => {
            inputs.forEach(el => {
                if (el.name && initialValues[el.name] !== undefined) {
                    el.value = initialValues[el.name];
                }
                if (el.name && el.name !== "email") {
                    el.setAttribute("readonly", true);
                    if (el.type === "file") el.setAttribute("disabled", true);
                }
                el.setAttribute("disabled", true);
                document.getElementById('fotoWrapper').classList.add("d-none");
            });
            editBtn.classList.remove("d-none");
            saveBtn.classList.add("d-none");
            cancelBtn.classList.add("d-none");
        });
    });

    document.getElementById('editBtn').addEventListener('click', function() {
        document.querySelectorAll('#profileForm input, #profileForm textarea').forEach(el => {
            if (el.name !== 'email') el.removeAttribute('readonly');
            if (el.id === 'fotoInput') {
                document.getElementById('fotoWrapper').classList.remove('d-none');
                el.removeAttribute('disabled');
            }
            el.removeAttribute('disabled');
        });
        document.getElementById('saveBtn').classList.remove('d-none');
        document.getElementById('cancelBtn').classList.remove('d-none');
        this.classList.add('d-none');
    });
</script>
@endsection