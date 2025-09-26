@extends('layouts.app')
@section('content')

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
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <!-- <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container ps-1 ms-5 me-0 pe-0">
                <a class="navbar-brand pe-5 me-5" href="{{ url('/home') }}">Wanna Be Studio
                    <!-- {{ config('app.name', 'Wanna Be Studio') }} -->
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav me-auto">

        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ms-auto">
            @guest
            @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @endif

            @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif
            @else
            <!-- <a href="{{ route('pegawais.index') }}" class="btn btn-primary btn-sm me-2 text-center align-middle">
                            Pegawai
                        </a> -->

            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
            @endguest
        </ul>
    </div>
    </div>
    </nav>

    <main class="py-1">
        @yield('content')
    </main>
    </div>

    <div class="container-fluid mt-0 pt-0 pe-4 ps-4">
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
                        <th>Foto</th>
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

                        <td class="text-center">
                            @if($pegawai->profile_photo)
                            <img src="{{ asset('storage/profile_photos/' . $pegawai->profile_photo) }}"
                                alt="Foto {{ $pegawai->nama }}"
                                width="100" height="100"
                                class="rounded-circle">
                            @else
                            <img src="{{ asset('storage/images/default_profile.jpg') }}"
                                alt="Default Foto"
                                width="100" height="100"
                                class="rounded-circle">
                            @endif
                        </td>

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
                        <td class="text-center">
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
@endsection