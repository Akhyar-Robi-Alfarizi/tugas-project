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
  @else <style>
    /*! tailwindcss v4 */
  </style> @endif
</head>

<body>
  <div class="flex min-h-[80vh]">
    @include('includes.sidebar')

    <main class="flex-1 p-10">
      <div class="flex items-start justify-between">
        <h1 class="text-3xl font-semibold tracking-tight">Laporan</h1>
        <div class="flex items-center gap-3">
          <span class="text-gray-600">
            {{ Auth::user()->nama ?? 'Guest' }}
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

      {{-- Tombol ekspor (placeholder route) --}}
      <div class="mt-6 flex gap-3">
        <a href="{{ route('export.pdf') }}"
          class="inline-flex items-center rounded-md bg-[#4B78AF] px-4 py-2 text-white shadow hover:bg-[#405875]">
          Export PDF
        </a>
        <a href="{{ route('export.excel') }}"
          class="inline-flex items-center rounded-md bg-[#4B78AF] px-4 py-2 text-white shadow hover:bg-[#405875]">
          Export Excel
        </a>
      </div>

      {{-- Total kas --}}
      <div class="mt-6 rounded-lg border border-gray-300 overflow-hidden">
        <div class="bg-gray-200 px-5 py-2 text-sm font-medium text-gray-700">Total kas</div>
        <div class="px-6 py-6 text-2xl font-semibold">
          Rp. {{ number_format($totalKas, 0, ',', '.') }}
        </div>
      </div>

      {{-- Dua kolom --}}
      <div class="mt-8 grid grid-cols-1 gap-8 md:grid-cols-2">
        <section>
          <h2 class="text-2xl font-medium">Siswa yang sudah Lunas ({{ $sudahBayar->count() }})</h2>
          <div class="mt-3 rounded-lg border border-gray-300 overflow-hidden">
            <ul class="divide-y divide-gray-200">
              @forelse ($sudahBayar as $s)
              <li class="px-4 py-2 text-sm">{{ $s->nama }} <span class="text-gray-500">— {{ $s->kelas }}</span></li>
              @empty
              <li class="px-4 py-4 text-sm text-gray-500">Belum ada yang lunas.</li>
              @endforelse
            </ul>
          </div>
        </section>

        <section>
          <h2 class="text-2xl font-medium">Siswa yang belum Lunas ({{ $belumBayar->count() }})</h2>
          <div class="mt-3 rounded-lg border border-gray-300 overflow-hidden">
            <ul class="divide-y divide-gray-200">
              @forelse ($belumBayar as $s)
              <li class="px-4 py-2 text-sm">{{ $s->nama }} <span class="text-gray-500">— {{ $s->kelas }}</span></li>
              @empty
              <li class="px-4 py-4 text-sm text-gray-500">Semua sudah lunas 🎉</li>
              @endforelse
            </ul>
          </div>
        </section>
      </div>
    </main>
  </div>
</body>

</html>