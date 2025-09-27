@php
  $active = 'block -mx-6 px-6 py-3 bg-[#A7D8E9]';
  $idle   = 'block -mx-6 px-6 py-3 hover:bg-[#A4D4E8] hover:text-black';
@endphp

<aside class="w-64 bg-[#D9ECFB]">
  <nav class="h-screen py-8">
    <ul class="flex flex-col gap-8 px-6">
      {{-- Dashboard --}}
      <li>
        <a href="/"
           class="{{ request()->is('dashboard') || request()->is('dashboard/beranda*') ? $active : $idle }}">
          Dashboard
        </a>
      </li>

      {{-- Data Siswa --}}
      <li>
        <a href="/data"
           class="{{ request()->is('dashboard/data-siswa*') || request()->is('dashboard/data_warga*') ? $active : $idle }}">
          Data Siswa
        </a>
      </li>

      {{-- Pembayaran --}}
      <li>
        <a href="/pembayaran"
           class="{{ request()->is('dashboard/pembayaran*') || request()->is('dashboard/data_kk*') ? $active : $idle }}">
          Pembayaran
        </a>
      </li>

      {{-- Laporan --}}
      <li>
        <a href="/laporan"
           class="{{ request()->is('dashboard/laporan*') ? $active : $idle }}">
          Laporan
        </a>
      </li>
    </ul>
  </nav>
</aside>
