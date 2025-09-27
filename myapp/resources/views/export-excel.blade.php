<table>
  <tr>
    <td colspan="2"><strong>Laporan Kas</strong></td>
  </tr>
  <tr>
    <td>Tanggal cetak</td>
    <td>{{ now()->format('d/m/Y H:i') }}</td>
  </tr>
  <tr>
    <td>Total Kas</td>
    {{-- biarkan angka apa adanya agar Excel mengenal sebagai number --}}
    <td>{{ $totalKas }}</td>
  </tr>
</table>

<br>

<table border="1">
  <thead>
    <tr>
      <th colspan="2">Siswa yang sudah Lunas ({{ $sudahBayar->count() }})</th>
    </tr>
    <tr>
      <th>Nama</th>
      <th>Kelas</th>
    </tr>
  </thead>
  <tbody>
    @forelse($sudahBayar as $s)
      <tr>
        <td>{{ $s->nama }}</td>
        <td>{{ $s->kelas }}</td>
      </tr>
    @empty
      <tr><td colspan="2">-</td></tr>
    @endforelse
  </tbody>
</table>

<br>

<table border="1">
  <thead>
    <tr>
      <th colspan="2">Siswa yang belum Lunas ({{ $belumBayar->count() }})</th>
    </tr>
    <tr>
      <th>Nama</th>
      <th>Kelas</th>
    </tr>
  </thead>
  <tbody>
    @forelse($belumBayar as $s)
      <tr>
        <td>{{ $s->nama }}</td>
        <td>{{ $s->kelas }}</td>
      </tr>
    @empty
      <tr><td colspan="2">-</td></tr>
    @endforelse
  </tbody>
</table>
