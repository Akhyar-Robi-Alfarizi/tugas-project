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
    /*! tailwindcss v4.0.7 */
  </style> @endif
</head>

<body>
  <div>
    <div class="flex min-h-[80vh]">
      @include('includes.sidebar')

      <main class="flex-1 p-10">
        <div class="flex items-start justify-between">
          <h1 class="text-3xl font-semibold tracking-tight">Pembayaran Uang Kas Kelas</h1>
          <div class="flex items-center gap-3">
            <span class="text-gray-600">
              {{ Auth::user()->name ?? 'Guest' }}
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

        {{-- 2 kartu atas --}}
        <div class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-2">
          {{-- Total Kas --}}
          <section class="rounded-xl border border-gray-300 p-6">
            <h2 class="text-xl font-medium">Total Kas</h2>
            <p class="mt-3 text-2xl font-semibold">
              Rp. {{ number_format($totalKas ?? 0, 0, ',', '.') }}
            </p>
          </section>

          {{-- Grafik per Bulan --}}
          <section class="rounded-xl border border-gray-300 p-6">
            <h2 class="text-xl font-medium">Pemasukan per Bulan</h2>
            <div class="mt-4">
              <canvas id="monthlyChart" height="120"></canvas>
            </div>
          </section>
        </div>

        {{-- Status Pembayaran (sampling 10 siswa) --}}
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
                @forelse ($sampleSiswa as $s)
                <tr class="text-sm">
                  <td class="px-6 py-3">{{ $s->nama }}</td>
                  <td class="px-6 py-3">{{ $s->nis }}</td>
                  <td class="px-6 py-3">{{ $s->kelas }}</td>
                  <td class="px-6 py-3">
                    @if ($s->lunas_count > 0)
                    <span class="inline-flex rounded-full bg-green-200 px-3 py-1 text-xs font-semibold text-green-800">Lunas</span>
                    @else
                    <span class="inline-flex rounded-full bg-red-200 px-3 py-1 text-xs font-semibold text-red-800">Belum Bayar</span>
                    @endif
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="4" class="px-6 py-6 text-center text-gray-500">Belum ada data siswa.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </section>
      </main>
    </div>
  </div>

  {{-- Chart.js CDN (ringan dan cepat) --}}
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const labels = {
      !!Illuminate\ Support\ Js::from($monthLabels ?? []) !!
    };
    const totals = {
      !!Illuminate\ Support\ Js::from($monthTotals ?? []) !!
    };

    const ctx = document.getElementById('monthlyChart').getContext('2d');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels,
        datasets: [{
          data: totals,
          borderWidth: 1
        }]
      },
      options: {
        plugins: {
          legend: {
            display: false
          }
        },
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>

</body>

</html>