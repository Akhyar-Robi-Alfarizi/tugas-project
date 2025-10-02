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
        <h1 class="text-3xl font-semibold tracking-tight">Pembayaran</h1>
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

      <div class="mt-6">
        <a href="{{ route('pembayaran.create') }}"
          class="inline-flex items-center rounded-md bg-[#4B78AF] px-4 py-2 text-white shadow hover:bg-[#405875]">
          + Tambah Pembayaran
        </a>
      </div>

      <div class="mt-6 overflow-hidden rounded-xl border border-gray-300">
        <table class="w-full text-left">
          <thead class="bg-gray-50 text-sm">
            <tr>
              <th class="px-6 py-3 font-medium text-gray-700">Nama</th>
              <th class="px-6 py-3 font-medium text-gray-700">Tanggal</th>
              <th class="px-6 py-3 font-medium text-gray-700">Nominal</th>
              <th class="px-6 py-3 font-medium text-gray-700">Status</th>
              <th class="px-6 py-3 font-medium text-gray-700">Action</th>
            </tr>
          </thead>

          <tbody class="divide-y divide-gray-200 text-sm">
            @forelse ($pembayaran as $p)
            <tr>
              <td class="px-6 py-3">{{ $p->siswa->nama ?? '-' }}</td>
              <td class="px-6 py-3">{{ \Carbon\Carbon::parse($p->tanggal_bayar)->translatedFormat('d F Y') }}</td>
              <td class="px-6 py-3">{{ number_format($p->jumlah, 0, ',', '.') }}</td>
              <td class="px-6 py-3">
                @if ($p->status === 'lunas')
                <span class="inline-flex rounded-full bg-green-200 px-3 py-1 text-xs font-semibold text-green-800">Lunas</span>
                @else
                <span class="inline-flex rounded-full bg-red-500/90 px-3 py-1 text-xs font-semibold text-white">Belum Lunas</span>
                @endif
              </td>
              <td class="px-6 py-3">
                <div class="flex gap-2">
                  <a href="{{ route('pembayaran.edit', $p) }}"
                    class="inline-flex items-center rounded-full bg-yellow-300/80 px-3 py-1 text-xs font-semibold text-gray-900 hover:bg-yellow-300">
                    Edit
                  </a>
                  <form method="POST" action="{{ route('pembayaran.destroy', $p) }}"
                    onsubmit="return confirm('Hapus data ini?');">
                    @csrf @method('DELETE')
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
              <td colspan="5" class="px-6 py-6 text-center text-gray-500">Belum ada pembayaran.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="mt-4">
        {{ $pembayaran->links() }}
      </div>
    </main>
  </div>
</body>

</html>