<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
      @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
      <style>/*! tailwindcss v4.0.7 */</style>
    @endif
  </head>

  <body>
    <div> 
      <div class="flex min-h-[80vh]">
        {{-- Sidebar --}}
        @include('includes.sidebar')

        {{-- Konten utama --}}
        <main class="flex-1 p-10">
          {{-- Header judul + user --}}
          <div class="flex items-start justify-between">
            <h1 class="text-3xl font-semibold tracking-tight">
              Pembayaran Uang Kas Kelas
            </h1>
            <div class="flex items-center gap-3">
              <span class="text-gray-600">Bendahara</span>
              <span class="h-10 w-10 rounded-full bg-blue-200 inline-block"></span>
            </div>
          </div>

          {{-- 2 kartu atas --}}
          <div class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-2">
            {{-- Kartu Total Kas --}}
            <section class="rounded-xl border border-gray-300 p-6">
              <h2 class="text-xl font-medium">Total Kas</h2>
              <p class="mt-3 text-2xl font-semibold">Rp. 3.500.000</p>
            </section>

            {{-- Kartu Pemasukan per Bulan (grafik batang statis) --}}
            <section class="rounded-xl border border-gray-300 p-6">
              <h2 class="text-xl font-medium">Pemasukan per Bulan</h2>
              <div class="mt-4">
                <div class="flex h-28 items-end gap-3 px-1">
                  <div class="w-6 rounded bg-blue-600 h-8"></div>
                  <div class="w-6 rounded bg-blue-600 h-12"></div>
                  <div class="w-6 rounded bg-blue-600 h-16"></div>
                  <div class="w-6 rounded bg-blue-600 h-20"></div>
                  <div class="w-6 rounded bg-blue-600 h-24"></div>
                  <div class="w-6 rounded bg-blue-600 h-16"></div>
                  <div class="w-6 rounded bg-blue-600 h-14"></div>
                </div>
                <div class="mt-2 border-t border-gray-300"></div>
              </div>
            </section>
          </div>

          {{-- Tabel Status Pembayaran --}}
          <section class="mt-10">
            <h2 class="text-2xl font-medium">Status Pembayaran</h2>

            <div class="mt-4 overflow-hidden rounded-xl border border-gray-300">
              <table class="w-full text-left">
                <thead class="bg-gray-50">
                  <tr class="text-sm">
                    <th class="px-6 py-3 font-medium text-gray-700">Nama</th>
                    <th class="px-6 py-3 font-medium text-gray-700">Nis</th>
                    <th class="px-6 py-3 font-medium text-gray-700">Kelas</th>
                    <th class="px-6 py-3 font-medium text-gray-700">Status</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                  <tr>
                    <td class="px-6 py-3">Aska</td>
                    <td class="px-6 py-3">09897343</td>
                    <td class="px-6 py-3">XII RPL 1</td>
                    <td class="px-6 py-3">
                      <span class="inline-flex rounded-full bg-green-200 px-3 py-1 text-xs font-semibold text-green-800">Lunas</span>
                    </td>
                  </tr>
                  <tr>
                    <td class="px-6 py-3">Ikhsan</td>
                    <td class="px-6 py-3">09897343</td>
                    <td class="px-6 py-3">XII RPL 1</td>
                    <td class="px-6 py-3">
                      <span class="inline-flex rounded-full bg-green-200 px-3 py-1 text-xs font-semibold text-green-800">Lunas</span>
                    </td>
                  </tr>
                  <tr>
                    <td class="px-6 py-3">Erlangga</td>
                    <td class="px-6 py-3">09897343</td>
                    <td class="px-6 py-3">XII RPL 1</td>
                    <td class="px-6 py-3">
                      <span class="inline-flex rounded-full bg-red-200 px-3 py-1 text-xs font-semibold text-red-800">Belum Bayar</span>
                    </td>
                  </tr>
                  <tr>
                    <td class="px-6 py-3">Fathir</td>
                    <td class="px-6 py-3">09897343</td>
                    <td class="px-6 py-3">XII RPL 1</td>
                    <td class="px-6 py-3">
                      <span class="inline-flex rounded-full bg-red-200 px-3 py-1 text-xs font-semibold text-red-800">Belum Bayar</span>
                    </td>
                  </tr>
                  <tr>
                    <td class="px-6 py-3">Arjoen</td>
                    <td class="px-6 py-3">09897343</td>
                    <td class="px-6 py-3">XII RPL 1</td>
                    <td class="px-6 py-3">
                      <span class="inline-flex rounded-full bg-green-200 px-3 py-1 text-xs font-semibold text-green-800">Lunas</span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </section>
        </main>
      </div>
    </div>
  </body>
</html>
