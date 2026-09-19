<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $jurusan->nama_jurusan }} — SMK Negeri 1 Cijati</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<link rel="stylesheet" href="{{ asset('css/jurusan-guru.css') }}">
</head>
<body style="background:#fff;">
<div class="ekskul-detail-page is-visible">

  <div class="jurusan-hero" style="--jurusan-accent:#F2994A;">
    <img class="jurusan-hero-img" src="{{ asset('storage/images/jurusan/'.$jurusan->foto) }}" alt="{{ $jurusan->nama_jurusan }}">
    <div class="jurusan-hero-top">
      <a href="{{ url('/') }}" class="jurusan-hero-back">← Kembali ke Beranda</a>
    </div>
    <div class="jurusan-hero-content">
      <div class="jurusan-hero-badge">PMS</div>
      <h1 class="jurusan-hero-title">{{ $jurusan->nama_jurusan }}</h1>
      <p class="jurusan-hero-subtitle">Kompetensi Keahlian · Bisnis Daring Pemasaran</p>
    </div>
    <div class="jurusan-hero-accent-bar"></div>
  </div>

  <div class="ekskul-detail-body">
    <div class="ekskul-detail-card">
      <h3>Tentang Jurusan</h3>
      <p>{{ $jurusan->deskripsi }}</p>
    </div>

    <div class="guru-section">
      <div class="guru-section-head">
        <h3>Tenaga Pendidik</h3>
        <span class="guru-section-count">Kepala Jurusan &amp; Guru Produktif {{ $jurusan->nama_jurusan }}</span>
      </div>

      {{-- ===== Kepala Jurusan (kartu unggulan, vertikal, terpusat) ===== --}}
      <div class="guru-lead">
        <div class="guru-lead-photo" data-name="{{ $jurusan->kepala_jurusan }}" data-subject="Kepala Jurusan">
          <img src="{{ asset('storage/images/jurusan/'.$jurusan->foto_kepala_jurusan) }}" alt="{{ $jurusan->kepala_jurusan }}">
        </div>
        <span class="guru-lead-role">Kepala Jurusan</span>
        <div class="guru-lead-name">{{ $jurusan->kepala_jurusan }}</div>
      </div>

      {{-- ===== Guru Produktif (grid) ===== --}}
      {{-- TODO: sesuaikan nama field ($g->nama, $g->foto, $g->mapel) dengan kolom asli di model Guru --}}
      <div class="guru-grid">
        @foreach($jurusan->guru as $g)
        <div class="guru-card">
          <div class="guru-card-photo" data-name="{{ $g->nama }}" data-subject="Guru Produktif">
            <img src="{{ asset('storage/images/guru-guru/'.$g->foto) }}" alt="{{ $g->nama }}">
          </div>
          <div class="guru-card-body">
            <div class="guru-card-name">{{ $g->nama }}</div>
            <div class="guru-card-subject">{{ $g->mapel ?? 'Guru Produktif' }}</div>
          </div>
        </div>
        @endforeach
      </div>
    </div>

    <div class="ekskul-detail-card">
      <h3>Galeri</h3>
      <img src="{{ asset('storage/images/jurusan/'.$jurusan->foto) }}" alt="Workshop {{ $jurusan->nama_jurusan }}" style="width:100%;border-radius:12px;">
    </div>
  </div>
</div>
<script src="{{ asset('js/jurusan-guru.js') }}"></script>
</body>
</html>