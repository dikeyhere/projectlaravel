<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawais = Pegawai::withTrashed()->get();
        return view('hrd.pegawai', compact('pegawais'));
    }


    public function create()
    {
        return view('hrd.inputpegawai');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100|unique:pegawais,nama',
            'alamat' => 'required|string|max:255',
            'email' => 'required|email|max:100|unique:pegawais,email',
            'telp' => 'required|string|max:15|unique:pegawais,telp',
            'jabatan' => 'required|string|max:50',
            'tglmasuk' => 'required|date',
            'gaji' => 'required|numeric|min:0',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
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
            'tglmasuk.required' => 'Tanggal Masuk wajib diisi',
            'gaji.required' => 'Gaji wajib diisi',
        ]);

        // Pegawai::create($request->all());

        $pegawai = new Pegawai($request->except('profile_photo'));

        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/profile_photos', $filename);

            $pegawai->profile_photo = $filename;
        }

        $pegawai->save();

        return redirect()->route('pegawais.index')
            ->with('success', 'Pegawai berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return view('hrd.editpegawai', compact('pegawai'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:100|unique:pegawais,nama,' . $id,
            'alamat' => 'required|string|max:255',
            'email' => 'required|email|max:100|unique:pegawais,email,' . $id,
            'telp' => 'required|string|max:15|unique:pegawais,telp,' . $id,
            'jabatan' => 'required|string|max:50',
            'tglmasuk' => 'required|date',
            'gaji' => 'required|numeric|min:0',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
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
            'tglmasuk.required' => 'Tanggal Masuk wajib diisi',
            'gaji.required' => 'Gaji wajib diisi',
        ]);

        $pegawai = Pegawai::findOrFail($id);
        // $pegawai->update($request->all());

        $pegawai->nama = $request->nama;
        $pegawai->alamat = $request->alamat;
        $pegawai->email = $request->email;
        $pegawai->telp = $request->telp;
        $pegawai->jabatan = $request->jabatan;
        $pegawai->tglmasuk = $request->tglmasuk;
        $pegawai->gaji = $request->gaji;

        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/profile_photos', $filename);

            $pegawai->profile_photo = $filename;
        }

        $pegawai->save();

        return redirect()->route('pegawais.index')
            ->with('success', 'Data pegawai berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();

        return redirect()->route('pegawais.index')->with('success', 'Data pegawai berhasil dihapus.');
    }

    public function restore($id)
    {
        $pegawai = Pegawai::withTrashed()->findOrFail($id);
        $pegawai->restore();

        return redirect()->route('pegawais.index')->with('success', 'Pegawai berhasil dikembalikan');
    }

    public function forceDelete($id)
    {
        $pegawai = Pegawai::withTrashed()->findOrFail($id);
        $pegawai->forceDelete();

        return redirect()->route('pegawais.index')->with('success', 'Pegawai dihapus permanen');
    }
}
