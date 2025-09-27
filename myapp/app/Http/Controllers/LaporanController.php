<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Pembayaran;
use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LaporanController extends Controller
{
    public function index()
    {
        [$totalKas, $sudahBayar, $belumBayar] = $this->dataLaporan();
        return view('laporan', compact('totalKas', 'sudahBayar', 'belumBayar'));
    }

    public function exportPdf()
    {
        [$totalKas, $sudahBayar, $belumBayar] = $this->dataLaporan();

        // Render Blade -> HTML
        $html = view('export-pdf', compact('totalKas','sudahBayar','belumBayar'))->render();

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $pdf = new Dompdf($options);
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();

        $filename = 'laporan-kas-'.now()->format('Ymd_His').'.pdf';
        return response($pdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', "attachment; filename=\"$filename\"");
    }

    public function exportExcel()
    {
        [$totalKas, $sudahBayar, $belumBayar] = $this->dataLaporan();

        $ss = new Spreadsheet();
        $sheet = $ss->getActiveSheet();

        // Header
        $sheet->setCellValue('A1', 'Laporan Kas');
        $sheet->setCellValue('A2', 'Tanggal cetak');
        $sheet->setCellValue('B2', now()->format('d/m/Y H:i'));
        $sheet->setCellValue('A3', 'Total Kas');
        $sheet->setCellValue('B3', $totalKas);

        // Sudah lunas
        $row = 5;
        $sheet->setCellValue("A{$row}", 'Siswa yang sudah Lunas'); $row++;
        $sheet->setCellValue("A{$row}", 'Nama'); $sheet->setCellValue("B{$row}", 'Kelas'); $row++;
        foreach ($sudahBayar as $s) {
            $sheet->setCellValue("A{$row}", $s->nama);
            $sheet->setCellValue("B{$row}", $s->kelas);
            $row++;
        }

        // Belum lunas
        $row += 2;
        $sheet->setCellValue("A{$row}", 'Siswa yang belum Lunas'); $row++;
        $sheet->setCellValue("A{$row}", 'Nama'); $sheet->setCellValue("B{$row}", 'Kelas'); $row++;
        foreach ($belumBayar as $s) {
            $sheet->setCellValue("A{$row}", $s->nama);
            $sheet->setCellValue("B{$row}", $s->kelas);
            $row++;
        }

        $writer = new Xlsx($ss);
        $filename = 'laporan-kas-'.now()->format('Ymd_His').'.xlsx';

        return response()->streamDownload(function() use ($writer) {
            $writer->save('php://output');
        }, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    /** Kumpulkan data laporan sekali di sini */
    private function dataLaporan(): array
    {
        $totalKas = Pembayaran::where('status', 'lunas')->sum('jumlah');

        $sudahBayar = Siswa::whereHas('pembayaran', fn($q) =>
            $q->where('status','lunas')
        )->orderBy('nama')->get();

        $belumBayar = Siswa::whereDoesntHave('pembayaran', fn($q) =>
            $q->where('status','lunas')
        )->orderBy('nama')->get();

        return [$totalKas, $sudahBayar, $belumBayar];
    }
}
