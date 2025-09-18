<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawais = Pegawai::all();
        return view('hrd.pegawai', compact('pegawais'));
    }

    public function create()
    {
        return view('hrd.inputpegawai');
    }

    // public function store(Request $request)
    // {
    //     Pegawai::create($request->all());
    //     return redirect()->route('pegawais.index');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100|unique:pegawais,nama',
            'alamat' => 'required|string|max:255',
            'email' => 'required|email|max:100|unique:pegawais,email',
            'telp' => 'required|string|max:15|unique:pegawais,telp',
            'jabatan' => 'required|string|max:50',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'nama.unique' => 'Nama sudah terdaftar, gunakan yang lain',
            'alamat.required' => 'Alamat wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'telp.required' => 'Nomor telepon wajib diisi',
            'telp.unique' => 'Nomor telepon sudah terdaftar',
            'jabatan.required' => 'Jabatan wajib dipilih',
        ]);

        Pegawai::create($request->all());

        return redirect()->route('pegawais.index')
            ->with('success', 'Pegawai berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return view('hrd.editpegawai', compact('pegawai'));
    }

    // public function update(Request $request, $id)
    // {
    //     $pegawai = Pegawai::findOrFail($id);
    //     $pegawai->update($request->all());

    //     return redirect()->route('pegawais.index')->with('success', 'Data pegawai berhasil diperbarui.');
    // }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:100|unique:pegawais,nama,' . $id,
            'alamat' => 'required|string|max:255',
            'email' => 'required|email|max:100|unique:pegawais,email,' . $id,
            'telp' => 'required|string|max:15|unique:pegawais,telp,' . $id,
            'jabatan' => 'required|string|max:50',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'nama.unique' => 'Nama sudah terdaftar',
            'alamat.required' => 'Alamat wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'telp.required' => 'Nomor telepon wajib diisi',
            'telp.unique' => 'Nomor telepon sudah terdaftar',
            'jabatan.required' => 'Jabatan wajib dipilih',
        ]);

        $pegawai = Pegawai::findOrFail($id);
        $pegawai->update($request->all());

        return redirect()->route('pegawais.index')
            ->with('success', 'Data pegawai berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();

        return redirect()->route('pegawais.index')->with('success', 'Data pegawai berhasil dihapus.');
    }
}
