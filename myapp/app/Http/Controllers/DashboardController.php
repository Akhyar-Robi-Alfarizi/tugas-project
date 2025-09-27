<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Pembayaran;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1) Total kas (hanya yang LUNAS)
        $totalKas = Pembayaran::where('status', 'lunas')->sum('jumlah');

        // 2) Status beberapa siswa (ambil 10 pertama by nama)
        //    Definisi "Lunas" = punya minimal 1 pembayaran status lunas
        $sampleSiswa = Siswa::withCount([
            'pembayaran as lunas_count' => function ($q) {
                $q->where('status', 'lunas');
            }
        ])
        ->orderBy('nama')
        ->take(10)
        ->get();

        // 3) Grafik pemasukan per bulan (12 bulan terakhir, hanya LUNAS)
        $start = now()->subMonths(11)->startOfMonth();
        $end   = now()->endOfMonth();

        // ambil total per YYYY-MM
        $map = Pembayaran::where('status', 'lunas')
            ->whereBetween('tanggal_bayar', [$start, $end])
            ->selectRaw("DATE_FORMAT(tanggal_bayar, '%Y-%m') as ym, SUM(jumlah) as total")
            ->groupBy('ym')
            ->orderBy('ym')
            ->pluck('total', 'ym'); // contoh: ['2025-01' => 1500000, ...]

        // susun array labels & totals berisi 12 bulan berturut
        $monthLabels = [];
        $monthTotals = [];

        for ($i = 0; $i < 12; $i++) {
            $m = (clone $start)->addMonths($i);
            $key = $m->format('Y-m');
            // Label singkat: Jan, Feb, ...
            // Jika ingin bahasa Indonesia, set config('app.locale') = 'id' dan pakai translatedFormat('M')
            $monthLabels[] = $m->format('M');
            $monthTotals[] = (float) ($map[$key] ?? 0);
        }

        return view('welcome', compact('totalKas', 'sampleSiswa', 'monthLabels', 'monthTotals'));
    }
}
