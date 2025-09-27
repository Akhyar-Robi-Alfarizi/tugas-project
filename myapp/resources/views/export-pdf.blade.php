<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <style>
    *{ font-family: DejaVu Sans, sans-serif; }
    h1{ margin:0 0 10px }
    .muted{ color:#666 }
    .box{ border:1px solid #ddd; border-radius:8px; padding:12px; margin:10px 0 }
    .grid{ display:flex; gap:16px }
    .col{ flex:1; border:1px solid #ddd; border-radius:8px }
    .col h3{ margin:0; padding:8px 10px; background:#f3f3f3; font-size:14px }
    .list{ margin:0; padding:0; list-style:none }
    .list li{ padding:8px 10px; border-top:1px solid #eee; font-size:12px }
    .badge{ display:inline-block; padding:2px 8px; border-radius:9999px; font-size:11px; background:#e6f4ea }
  </style>
</head>
<body>
  <h1>Laporan Kas</h1>
  <div class="muted">{{ now()->format('d/m/Y H:i') }}</div>

  <div class="box"><strong>Total Kas:</strong>
    Rp {{ number_format($totalKas,0,',','.') }}
  </div>

  <div class="grid">
    <div class="col">
      <h3>Siswa yang sudah Lunas ({{ $sudahBayar->count() }})</h3>
      <ul class="list">
        @forelse($sudahBayar as $s)
          <li>{{ $s->nama }} — <span class="badge">Lunas</span></li>
        @empty
          <li>Tidak ada data.</li>
        @endforelse
      </ul>
    </div>
    <div class="col">
      <h3>Siswa yang belum Lunas ({{ $belumBayar->count() }})</h3>
      <ul class="list">
        @forelse($belumBayar as $s)
          <li>{{ $s->nama }} — {{ $s->kelas }}</li>
        @empty
          <li>Semua sudah lunas.</li>
        @endforelse
      </ul>
    </div>
  </div>
</body>
</html>
