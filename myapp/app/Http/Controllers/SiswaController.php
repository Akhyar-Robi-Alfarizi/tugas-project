<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::latest()->paginate(10);
        return view('data.data', compact('siswa'));
    }

    public function create()
    {
        return view('data.tambah');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:150',
            'nis'  => 'required|string|max:20|unique:siswa,nis',
            'kelas'=> 'required|string|max:150',
        ]);

        Siswa::create($data);

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambahkan');
    }

    public function show(Siswa $siswa)
    {
        return view('siswa.show', compact('siswa'));
    }

    public function edit(Siswa $siswa)
    {
        return view('data.edit', compact('siswa'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:150',
            'nis'  => 'required|string|max:20|unique:siswa,nis,' . $siswa->id,
            'kelas'=> 'required|string|max:150',
        ]);

        $siswa->update($data);

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil diperbarui');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return back()->with('success', 'Siswa berhasil dihapus');
    }
}
