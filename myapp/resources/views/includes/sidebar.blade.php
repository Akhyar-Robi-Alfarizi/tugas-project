@php
$active = 'block -mx-6 px-6 py-3 bg-[#A7D8E9]';
$idle = 'block -mx-6 px-6 py-3 hover:bg-[#A4D4E8] hover:text-black';
@endphp

<aside class="w-64 bg-[#D9ECFB]">
  <nav class="h-screen py-8">
    <ul class="flex flex-col gap-8 px-6">

      {{-- Dashboard --}}
      <li>
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? $active : $idle }}">Dashboard</a>
      </li>

      {{-- Data Siswa --}}
      <li>
        <a href="{{ route('siswa.index') }}"
          class="{{ request()->routeIs('siswa.*') ? $active : $idle }}">
          Data Siswa
        </a>
      </li>

      {{-- Pembayaran --}}
      <li>
        <a href="{{ route('pembayaran.index') }}"
          class="{{ request()->routeIs('pembayaran.*') ? $active : $idle }}"
          @if(request()->routeIs('pembayaran.*')) aria-current="page" @endif>
          Pembayaran
        </a>
      </li>
      
      {{-- Laporan --}}
      <li>
        <a href="{{ route('laporan') }}"
          class="{{ request()->routeIs('laporan') ? $active : $idle }}">
          Laporan
        </a>
      </li>

    </ul>
  </nav>
</aside>