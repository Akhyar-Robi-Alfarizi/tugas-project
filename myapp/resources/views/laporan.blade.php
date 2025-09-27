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
            <h1 class="text-3xl font-semibold tracking-tight">Laporan</h1>
            <div class="flex items-center gap-3">
              <span class="text-gray-600">Bendahara</span>
              <span class="inline-block h-10 w-10 rounded-full bg-blue-200"></span>
            </div>
          </div>

          {{-- Tombol ekspor --}}
          <div class="mt-6 flex gap-3">
            <a href=""
               class="inline-flex items-center rounded-md bg-[#4B78AF] px-4 py-2 text-white shadow hover:bg-[#405875]">
              Expor PDF
            </a>
            <a href=""
               class="inline-flex items-center rounded-md bg-[#4B78AF] px-4 py-2 text-white shadow hover:bg-[#405875]">
              Expor Excel
            </a>
          </div>

          {{-- Kartu Total Kas --}}
          <div class="mt-6 rounded-lg border border-gray-300 overflow-hidden">
            <div class="bg-gray-200 px-5 py-2 text-sm font-medium text-gray-700">
              Total kas
            </div>
            <div class="px-6 py-6 text-2xl font-semibold">
              {{-- ganti $totalKas dengan variabel dari controller bila ada --}}
              Rp. {{ isset($totalKas) ? number_format($totalKas, 0, ',', '.') : '3.000.000' }}
            </div>
          </div>

          {{-- Dua kolom daftar --}}
          <div class="mt-8 grid grid-cols-1 gap-8 md:grid-cols-2">
            {{-- Siswa yang sudah Lunas --}}
            <section>
              <h2 class="text-2xl font-medium">Siswa yang sudah Lunas</h2>
              <div class="mt-3 rounded-lg border border-gray-300 overflow-hidden">
                <ul class="divide-y divide-gray-200">
                  @php
                    $sudah = [
                      'Akhyar Robi Alfarizi',
                      'Erlangga Rizki Perdana Putra',
                      'Fathir Aghfani Salam',
                      'Ronan Hidayat',
                      'Alif Fataisza',
                      'Naufal Albi Juni',
                    ];
                  @endphp
                  @foreach ($sudah as $nama)
                    <li class="px-4 py-2 text-sm">{{ $nama }}</li>
                  @endforeach
                </ul>
              </div>
            </section>

            {{-- Siswa yang belum Lunas --}}
            <section>
              <h2 class="text-2xl font-medium">Siswa yang belum Lunas</h2>
              <div class="mt-3 rounded-lg border border-gray-300 overflow-hidden">
                <ul class="divide-y divide-gray-200">
                  @php
                    $belum = [
                      'Arjoen Rido Pratama',
                      'Arfai Habibur Rahman',
                      'Cahaya Angga',
                      'Muhammad Zakky Almaraghi',
                      'Muhammad Hafidz Tri Prayogo',
                      'Rafif Faiz Indar Putra',
                    ];
                  @endphp
                  @foreach ($belum as $nama)
                    <li class="px-4 py-2 text-sm">{{ $nama }}</li>
                  @endforeach
                </ul>
              </div>
            </section>
          </div>
        </main>
      </div>
    </div>
  </body>
</html>
