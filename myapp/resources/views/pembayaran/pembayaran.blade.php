<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
      @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
      <style>/*! tailwindcss v4 */</style>
    @endif
  </head>

  <body>
    <div>
      <div class="flex min-h-[80vh]">
        {{-- Sidebar --}}
        @include('includes.sidebar')

        {{-- Konten --}}
        <main class="flex-1 p-10">
          {{-- Header judul + user --}}
          <div class="flex items-start justify-between">
            <h1 class="text-3xl font-semibold tracking-tight">Pembayaran</h1>
            <div class="flex items-center gap-3">
              <span class="text-gray-600">Bendahara</span>
              <span class="inline-block h-10 w-10 rounded-full bg-blue-200"></span>
            </div>
          </div>

          {{-- Tombol tambah pembayaran --}}
          <div class="mt-6">
            <a href="/tambahpembayaran"
               class="inline-flex items-center rounded-md bg-[#4B78AF] px-4 py-2 text-white shadow hover:bg-[#405875]">
              + Tambah Pembayaran
            </a>
          </div>

          {{-- Tabel pembayaran --}}
          <div class="mt-6 overflow-hidden rounded-xl border border-gray-300">
            <table class="w-full text-left">
              <thead class="bg-gray-50 text-sm">
                <tr>
                  <th class="px-6 py-3 font-medium text-gray-700">Nama</th>
                  <th class="px-6 py-3 font-medium text-gray-700">Tanggal</th>
                  <th class="px-6 py-3 font-medium text-gray-700">Nominal</th>
                  <th class="px-6 py-3 font-medium text-gray-700">Status</th>
                </tr>
              </thead>

              {{-- contoh data statis agar tampilan sama seperti gambar --}}
              <tbody class="divide-y divide-gray-200 text-sm">
                @php
                  use Carbon\Carbon;
                  $rows = [
                    ['Akhyar Robi', '2025-04-24', 5000, false],
                    ['Fadlan Nabil', '2025-04-24', 5000, false],
                    ['Meazza', '2025-04-24', 5000, false],
                    ['Fathir', '2025-04-24', 5000, false],
                    ['Erlangga', '2025-04-24', 5000, false],
                    ['Rafa', '2025-04-24', 5000, true],
                    ['Naufal', '2025-04-24', 5000, true],
                    ['Zaki', '2025-04-24', 5000, true],
                    ['Aska', '2025-04-24', 5000, true],
                    ['Ikhsan', '2025-04-24', 5000, true],
                    ['Arjoen', '2025-04-24', 5000, true],
                  ];
                @endphp

                @foreach ($rows as [$nama,$tanggal,$nominal,$lunas])
                  <tr>
                    <td class="px-6 py-3">{{ $nama }}</td>
                    <td class="px-6 py-3">{{ Carbon::parse($tanggal)->translatedFormat('d F Y') }}</td>
                    <td class="px-6 py-3">{{ number_format($nominal, 0, ',', '.') }}</td>
                    <td class="px-6 py-3">
                      @if ($lunas)
                        <span class="inline-flex rounded-full bg-green-200 px-3 py-1 text-xs font-semibold text-green-800">Lunas</span>
                      @else
                        <span class="inline-flex rounded-full bg-red-500/90 px-3 py-1 text-xs font-semibold text-white">Belum Lunas</span>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>
  </body>
</html>
