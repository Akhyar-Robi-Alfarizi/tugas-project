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
  <style>
    /*! tailwindcss v4 */
  </style>
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
            <div class="flex items-center gap-3">
            <span class="text-gray-600">
            {{ Auth::user()->nama ?? 'Guest' }}
            @auth <span class="ml-1 text-gray-500">({{ ucfirst(Auth::user()->role) }})</span> @endauth
          </span>

            {{-- Tombol logout --}}
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit"
                class="rounded-md bg-red-500 px-3 py-1 text-white text-sm hover:bg-red-600">
                Logout
              </button>
            </form>

            <span class="h-10 w-10 rounded-full bg-blue-200 inline-block"></span>
          </div>
          </div>
        </div>

        {{-- tombol kembali --}}
        <a href="{{ route('siswa.index') }}"
          class="inline-flex items-center gap-2 rounded-md bg-[#4B78AF] px-4 py-2 text-white shadow hover:bg-[#405875]">
          ← kembali
        </a>

        <form method="POST" action="{{ route('siswa.store') }}" class="mt-6 space-y-6">
          @csrf

          <div class="max-w-5xl">
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
            <input type="text" name="nama" value="{{ old('nama') }}" class="block w-full rounded-md border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-1 focus:ring-blue-500" required>
            @error('nama') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
          </div>

          <div class="max-w-xl">
            <label class="block text-sm font-medium text-gray-700 mb-1">NIS</label>
            <input type="text" name="nis" value="{{ old('nis') }}" class="block w-full rounded-md border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-1 focus:ring-blue-500" required>
            @error('nis') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
          </div>

          <div class="max-w-xl">
            <label class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
            <input type="text" name="kelas" value="{{ old('kelas') }}" class="block w-full rounded-md border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-1 focus:ring-blue-500" required>
            @error('kelas') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
          </div>

          <div class="max-w-xl">
            <button type="submit" class="w-full rounded-md bg-[#4B78AF] px-4 py-2 text-white shadow hover:bg-[#405875]">
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