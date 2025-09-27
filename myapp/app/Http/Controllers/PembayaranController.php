<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayaran = Pembayaran::with(['siswa', 'user'])->latest()->paginate(10);
        return view('pembayaran.pembayaran', compact('pembayaran'));
    }

    public function create()
    {
        $siswa = Siswa::orderBy('nama')->get();
        return view('pembayaran.tambah', compact('siswa'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'siswa_id'      => 'required|exists:siswa,id',
            'tanggal_bayar' => 'required|date',
            'jumlah'        => 'required|numeric|min:0',
            'status'        => 'required|in:lunas,belum_lunas',
        ]);

        $data['created_by'] = $request->user()->id; // pastikan user login

        Pembayaran::create($data);

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil disimpan');
    }

    public function show(Pembayaran $pembayaran)
    {
        $pembayaran->load(['siswa', 'user']);
        return view('pembayaran.show', compact('pembayaran'));
    }

    public function edit(Pembayaran $pembayaran)
    {
        $siswa = Siswa::orderBy('nama')->get();
        return view('pembayaran.edit', compact('pembayaran', 'siswa'));
    }

    public function update(Request $request, Pembayaran $pembayaran)
    {
        $data = $request->validate([
            'siswa_id'      => 'required|exists:siswa,id',
            'tanggal_bayar' => 'required|date',
            'jumlah'        => 'required|numeric|min:0',
            'status'        => 'required|in:lunas,belum_lunas',
        ]);

        $pembayaran->update($data);

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil diperbarui');
    }

    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();
        return back()->with('success', 'Pembayaran berhasil dihapus');
    }
}
