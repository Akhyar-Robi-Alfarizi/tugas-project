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
      {{-- Sidebar (pakai include yang sama) --}}
      @include('includes.sidebar')

      {{-- Konten --}}
      <main class="flex-1 p-10">
        {{-- Header judul + user --}}
        <div class="flex items-start justify-between">
          <h1 class="text-3xl font-semibold tracking-tight">Data Siswa</h1>
          <div class="flex items-center gap-3">
            <span class="text-gray-600">Bendahara</span>
            <span class="inline-block h-10 w-10 rounded-full bg-blue-200"></span>
          </div>
        </div>

        {{-- ... header & tombol tambah tetap ... --}}
        <a href="{{ route('siswa.create') }}"
          class="inline-flex items-center rounded-md bg-[#4B78AF] px-4 py-2 text-white shadow hover:bg-[#405875]">
          + Tambah Siswa
        </a>

        <div class="mt-6 overflow-hidden rounded-xl border border-gray-300">
          <table class="w-full text-left">
            <thead class="bg-gray-50 text-sm">
              <tr>
                <th class="px-6 py-3 font-medium text-gray-700">Nama</th>
                <th class="px-6 py-3 font-medium text-gray-700">NIS</th>
                <th class="px-6 py-3 font-medium text-gray-700">Kelas</th>
                <th class="px-6 py-3 font-medium text-gray-700">Action</th>
              </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
              @forelse ($siswa as $s)
              <tr class="text-sm">
                <td class="px-6 py-3">{{ $s->nama }}</td>
                <td class="px-6 py-3">{{ $s->nis }}</td>
                <td class="px-6 py-3">{{ $s->kelas }}</td>
                <td class="px-6 py-3">
                  <div class="flex gap-2">
                    <a href="{{ route('siswa.edit', $s) }}"
                      class="inline-flex items-center rounded-full bg-yellow-300/80 px-3 py-1 text-xs font-semibold text-gray-900 hover:bg-yellow-300">
                      Edit
                    </a>
                    <form method="POST" action="{{ route('siswa.destroy', $s) }}"
                      onsubmit="return confirm('Hapus data ini?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit"
                        class="inline-flex items-center rounded-full bg-red-500 px-3 py-1 text-xs font-semibold text-white hover:bg-red-600">
                        Delete
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="4" class="px-6 py-6 text-center text-sm text-gray-500">Belum ada data.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
          {{ $siswa->links() }}
        </div>

      </main>
    </div>
  </div>
</body>

</html>