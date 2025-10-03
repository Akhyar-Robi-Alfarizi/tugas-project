<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'Laravel') }}</title>

  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

  {{-- Tailwind via Vite (kalau ada), kalau tidak pakai CDN --}}
  @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  @else
    <script src="https://cdn.tailwindcss.com"></script>
  @endif

  {{-- AlpineJS untuk modal --}}
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

  {{-- Hilangkan flicker modal sebelum Alpine siap --}}
  <style>[x-cloak]{ display:none !important; }</style>
</head>

<body class="font-sans antialiased">
  <div class="flex min-h-[80vh]">
    @include('includes.sidebar')

    <main
      class="flex-1 p-10"
      x-data="confirmBox()"
      @keydown.escape.window="close()"
    >
      {{-- Header --}}
      <div class="flex items-start justify-between">
        <h1 class="text-3xl font-semibold tracking-tight">Pembayaran</h1>
        <div class="flex items-center gap-3">
          <span class="text-gray-600">
            {{ Auth::user()->nama ?? 'Guest' }}
            @auth <span class="ml-1 text-gray-500">({{ ucfirst(Auth::user()->role) }})</span> @endauth
          </span>

          {{-- Logout --}}
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
              class="rounded-md bg-red-500 px-3 py-1 text-white text-sm hover:bg-red-600">
              Logout
            </button>
          </form>

          <span class="inline-block h-10 w-10 rounded-full bg-blue-200"></span>
        </div>
      </div>

      {{-- Tambah --}}
      <div class="mt-6">
        <a href="{{ route('pembayaran.create') }}"
           class="inline-flex items-center rounded-md bg-[#4B78AF] px-4 py-2 text-white shadow hover:bg-[#405875]">
          + Tambah Pembayaran
        </a>
      </div>

      {{-- Tabel --}}
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

                    {{-- BUKAN form; tombol ini hanya membuka modal --}}
                    <button type="button"
                      @click="open('{{ route('pembayaran.destroy', $p) }}', '{{ $p->siswa->nama ?? '-' }}', '{{ \Carbon\Carbon::parse($p->tanggal_bayar)->translatedFormat('d F Y') }}')"
                      class="inline-flex items-center rounded-full bg-red-500 px-3 py-1 text-xs font-semibold text-white hover:bg-red-600">
                      Delete
                    </button>
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

      {{-- Pagination --}}
      <div class="mt-4">
        {{ $pembayaran->links() }}
      </div>

      {{-- ===== Modal Konfirmasi (Tailwind + Alpine) ===== --}}
      <div
        x-show="show"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm"
        @click.self="close()"
        x-transition.opacity
        aria-modal="true"
        role="dialog"
      >
        <div
          class="w-full max-w-sm rounded-xl bg-white p-6 shadow-xl"
          x-transition.scale
        >
          <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-yellow-50">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.72-1.36 3.485 0l6.518 11.597c.75 1.335-.213 2.999-1.742 2.999H3.48c-1.53 0-2.492-1.664-1.742-2.999L8.257 3.1zM11 14a1 1 0 10-2 0 1 1 0 002 0zm-1-2a1 1 0 01-1-1V8a1 1 0 112 0v3a1 1 0 01-1 1z" clip-rule="evenodd" />
            </svg>
          </div>

          <h2 class="mb-2 text-center text-lg font-semibold text-gray-900">Hapus pembayaran ini?</h2>
          <p class="mb-6 text-center text-sm text-gray-600">
            Data <span class="font-medium text-gray-800" x-text="info.nama"></span>
            tanggal <span class="font-medium text-gray-800" x-text="info.tanggal"></span> akan dihapus permanen.
          </p>

          <form :action="action" method="POST" class="mt-2 flex justify-center gap-3">
            @csrf
            @method('DELETE')

            <button type="button"
              @click="close()"
              class="rounded-md bg-gray-200 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-300">
              Batal
            </button>

            <button type="submit"
              class="rounded-md bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700">
              Hapus
            </button>
          </form>
        </div>
      </div>
      {{-- ===== /Modal ===== --}}
    </main>
  </div>

  {{-- Komponen Alpine untuk modal --}}
  <script>
    function confirmBox() {
      return {
        show: false,
        action: '#',
        info: { nama: '', tanggal: '' },
        open(url, nama, tanggal) {
          this.action = url;
          this.info.nama = nama;
          this.info.tanggal = tanggal;
          this.show = true;
        },
        close() { this.show = false; },
      }
    }
  </script>
</body>
</html>
