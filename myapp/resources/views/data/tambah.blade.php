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

          {{-- Tombol kembali --}}
          <div class="mt-6">
            <a href="{{ url()->previous() ?: route('pembayaran.index') }}"
               class="inline-flex items-center gap-2 rounded-md bg-[#4B78AF] px-4 py-2 text-white shadow hover:bg-[#405875]">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                <path d="M14 7l-5 5 5 5V7z"/>
              </svg>
              kembali
            </a>
          </div>

          {{-- Form --}}
          <form method="POST" action="" class="mt-6 space-y-6">
            @csrf

            {{-- NAMA (full width) --}}
            <div class="max-w-5xl">
              <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
              <input type="text" name="nama" value="{{ old('nama') }}"
                     class="block w-full rounded-md border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                     placeholder="" required>
            </div>

            {{-- NIS (setengah) --}}
            <div class="max-w-xl">
              <label class="block text-sm font-medium text-gray-700 mb-1">Nis</label>
              <input type="text" name="nis" value="{{ old('nis') }}"
                     class="block w-full rounded-md border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                     required>
            </div>

            {{-- KELAS (setengah) --}}
            <div class="max-w-xl">
              <label class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
              <input type="text" name="kelas" value="{{ old('kelas') }}"
                     class="block w-full rounded-md border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                     required>
            </div>

            {{-- Submit (lebar seperti contoh) --}}
            <div class="max-w-xl">
              <button type="submit"
                      class="w-full rounded-md bg-[#4B78AF] px-4 py-2 text-white shadow hover:bg-[#405875]">
                Simpan
              </button>
            </div>
          </form>

          {{-- Error message (opsional) --}}
          @if ($errors->any())
            <div class="mt-6 max-w-2xl rounded-md bg-red-50 p-4 text-sm text-red-700">
              <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
        </main>
      </div>
    </div>
  </body>
</html>
