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

    public function store(Request $request)
    {
        Pegawai::create($request->all());
        return redirect()->route('pegawais.index');
    }

    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return view('hrd.editpegawai', compact('pegawai'));
    }

    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->update($request->all());

        return redirect()->route('pegawais.index')->with('success', 'Data pegawai berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();

        return redirect()->route('pegawais.index')->with('success', 'Data pegawai berhasil dihapus.');
    }
}
