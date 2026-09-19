<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $ekskul->nama ?? 'Marching Band' }} — {{ $profil->nama_sekolah ?? 'SMK Negeri 1 Cijati' }}</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
  :root{
    --navy-900:#0b2340;
    --navy-800:#123157;
    --navy-700:#1a3f6e;
    --gold:#f5a623;
    --text-dark:#1f2937;
    --text-muted:#6b7280;
    --bg-soft:#f4f6fa;
    --radius:16px;
  }
  *{box-sizing:border-box;margin:0;padding:0;}
  body{font-family:'Poppins',sans-serif;background:var(--bg-soft);color:var(--text-dark);}
  a{text-decoration:none;}

  .topbar{
    position:sticky;top:0;z-index:20;
    display:flex;align-items:center;justify-content:space-between;
    padding:16px 32px;background:var(--navy-900);
  }
  .topbar .brand{color:#fff;font-weight:700;font-size:15px;letter-spacing:.3px;}
  .back-btn{
    display:inline-flex;align-items:center;gap:8px;
    background:rgba(255,255,255,.12);color:#fff;
    padding:8px 16px;border-radius:999px;font-size:13px;font-weight:500;
    transition:background .2s;
  }
  .back-btn:hover{background:rgba(255,255,255,.22);}

  .hero{
    position:relative;
    height:70vh;min-height:420px;
    display:flex;align-items:flex-end;
    overflow:hidden;
    background:linear-gradient(160deg,var(--navy-800) 0%,var(--navy-900) 100%);
  }
  .hero img{
    position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center 30%;
  }
  .hero::after{
    content:"";position:absolute;inset:0;
    background:linear-gradient(180deg,rgba(11,35,64,.15) 0%,rgba(11,35,64,.35) 55%,rgba(11,35,64,.92) 100%);
  }
  .hero-content{
    position:relative;z-index:2;
    width:100%;padding:0 32px 44px;
    display:flex;flex-direction:column;align-items:center;text-align:center;
  }
  .hero-badge{
    width:64px;height:64px;border-radius:50%;
    background:var(--gold);
    display:flex;align-items:center;justify-content:center;
    box-shadow:0 6px 18px rgba(0,0,0,.35);
    margin-bottom:14px;
  }
  .hero-badge svg{width:32px;height:32px;color:#0b2340;}
  .hero-content h1{
    color:#fff;font-size:38px;font-weight:800;letter-spacing:.3px;
  }
  .hero-content p{
    color:#d7e2f0;margin-top:8px;font-size:15px;max-width:560px;
  }
  .hero-tag{
    display:inline-block;color:var(--gold);font-weight:600;font-size:13px;
    letter-spacing:1.5px;text-transform:uppercase;margin-bottom:8px;
  }
  .photo-placeholder{
    position:absolute;inset:0;
    display:flex;align-items:center;justify-content:center;
    text-align:center;color:#8ba3c4;font-size:14px;font-weight:500;
    letter-spacing:.3px;
  }

  .wrap{max-width:1000px;margin:0 auto;padding:40px 24px 80px;}

  .card{
    background:#fff;border-radius:var(--radius);
    box-shadow:0 4px 20px rgba(15,35,60,.06);
    padding:28px;margin-bottom:24px;
  }

  .about-card{display:flex;gap:24px;align-items:flex-start;}
  .about-photo{width:170px;flex-shrink:0;text-align:center;}
  .about-photo img{
    width:170px;height:170px;object-fit:cover;border-radius:14px;display:block;
  }
  .about-photo .foto-kosong{
    width:170px;height:170px;border-radius:14px;
    background:var(--bg-soft);border:1.5px dashed #d7deea;
    display:flex;align-items:center;justify-content:center;
    color:var(--text-muted);font-size:11.5px;text-align:center;padding:8px;
  }
  .about-photo .caption{
    display:block;margin-top:8px;font-size:12.5px;font-weight:600;color:var(--navy-900);line-height:1.4;
  }
  .about-photo .caption small{
    display:block;font-weight:500;color:var(--text-muted);font-size:11px;text-transform:uppercase;letter-spacing:.5px;margin-top:2px;
  }
  .about-card .txt h2{font-size:20px;font-weight:700;color:var(--navy-900);margin-bottom:4px;}
  .about-card .txt span.eyebrow{color:var(--gold);font-weight:600;font-size:12px;text-transform:uppercase;letter-spacing:1px;}
  .about-card .txt p{color:var(--text-muted);font-size:14.5px;line-height:1.7;margin-top:10px;}

  .card h3{font-size:18px;font-weight:700;color:var(--navy-900);margin-bottom:14px;display:flex;align-items:center;gap:10px;}
  .card h3::before{content:"";width:6px;height:6px;border-radius:50%;background:var(--gold);}

  ul.list{list-style:none;}
  ul.list li{
    position:relative;padding:10px 0 10px 26px;color:var(--text-dark);font-size:14.5px;
    border-bottom:1px solid #eef1f6;
  }
  ul.list li:last-child{border-bottom:none;}
  ul.list li::before{
    content:"✓";position:absolute;left:0;top:9px;
    color:var(--gold);font-weight:700;
  }

  .info-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:18px;}
  .info-item{background:var(--bg-soft);border-radius:12px;padding:16px 18px;}
  .info-item .label{font-size:11px;text-transform:uppercase;letter-spacing:1px;color:var(--text-muted);font-weight:600;}
  .info-item .value{font-size:15px;font-weight:600;color:var(--navy-900);margin-top:4px;}

  .gallery{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;}
  .gallery img{width:100%;height:130px;object-fit:cover;border-radius:12px;}
  .gallery-placeholder{
    width:100%;height:130px;border-radius:12px;
    background:var(--bg-soft);border:1.5px dashed #d7deea;
    display:flex;align-items:center;justify-content:center;
    color:var(--text-muted);font-size:12px;text-align:center;padding:8px;
  }

  .actions{display:flex;gap:14px;justify-content:center;margin-top:8px;flex-wrap:wrap;}
  .btn{
    padding:13px 28px;border-radius:999px;font-weight:600;font-size:14px;
    display:inline-flex;align-items:center;gap:8px;
  }
  .btn.primary{background:var(--gold);color:var(--navy-900);}
  .btn.primary:hover{background:#e0951b;}
  .btn.secondary{background:#fff;color:var(--navy-900);border:1.5px solid #dde3ec;}
  .btn.secondary:hover{background:var(--bg-soft);}

  footer{
    text-align:center;padding:26px;color:var(--text-muted);font-size:13px;background:#fff;border-top:1px solid #eef1f6;
  }

  @media (max-width:640px){
    .hero-content h1{font-size:28px;}
    .about-card{flex-direction:column;}
    .about-photo{width:100%;}
    .about-photo img, .about-photo .foto-kosong{width:100%;height:220px;}
    .info-grid{grid-template-columns:1fr;}
    .gallery{grid-template-columns:1fr 1fr;}
  }
</style>
</head>
<body>

  <div class="topbar">
    <span class="brand">{{ $profil->nama_sekolah ?? 'SMK Negeri 1 Cijati' }}</span>
    <a href="{{ url('/') }}" class="back-btn">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5"/><path d="m12 19-7-7 7-7"/></svg>
      Beranda
    </a>
  </div>

  <section class="hero">
    @if($ekskul && $ekskul->foto)
      <img src="{{ asset('storage/images/'.$ekskul->foto) }}" alt="Kegiatan Ekstrakurikuler {{ $ekskul->nama ?? 'Marching Band' }}">
    @else
      <div class="photo-placeholder">Foto kegiatan menyusul</div>
    @endif
    <div class="hero-content">
      <div class="hero-badge">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>
      </div>
      <span class="hero-tag">Ekstrakurikuler · Musik & Formasi</span>
      <h1>{{ $ekskul->nama ?? 'Marching Band' }}</h1>
      <p>Bermain musik tiup dan perkusi secara berkelompok sekaligus formasi baris-berbaris yang atraktif.</p>
    </div>
  </section>

  <div class="wrap">

    <div class="card about-card">
      <div class="about-photo">
        @if($ekskul && $ekskul->pembina && $ekskul->pembina->foto)
          <img src="{{ asset('storage/images/guru-guru/'.rawurlencode($ekskul->pembina->foto)) }}" alt="{{ $ekskul->pembina->nama }} - Pembina {{ $ekskul->nama ?? 'Marching Band' }}">
        @else
          <div class="foto-kosong">Foto pembina menyusul</div>
        @endif
        <span class="caption">
          {{ $ekskul->pembina->nama ?? 'Pembina belum diisi' }}
          <small>Pembina {{ $ekskul->nama ?? 'Marching Band' }}</small>
        </span>
      </div>
      <div class="txt">
        <span class="eyebrow">Tentang</span>
        <h2>Ekstrakurikuler {{ $ekskul->nama ?? 'Marching Band' }}</h2>
        <p>{{ $ekskul->deskripsi ?? 'Deskripsi belum diisi.' }}</p>
      </div>
    </div>

    <div class="card">
      <h3>Kegiatan Rutin</h3>
      <ul class="list">
        @forelse(($ekskul->kegiatan_rutin ?? []) as $kegiatan)
          <li>{{ $kegiatan }}</li>
        @empty
          <li>Belum ada data kegiatan rutin.</li>
        @endforelse
      </ul>
    </div>

    <div class="card">
      <h3>Informasi</h3>
      <div class="info-grid">
        <div class="info-item">
          <div class="label">Pembina</div>
          <div class="value">{{ $ekskul->pembina->nama ?? '-' }}</div>
        </div>
        <div class="info-item">
          <div class="label">Jadwal</div>
          <div class="value">{{ $ekskul->jadwal ?? '-' }}</div>
        </div>
        <div class="info-item">
          <div class="label">Lokasi</div>
          <div class="value">{{ $ekskul->lokasi ?? '-' }}</div>
        </div>
        <div class="info-item">
          <div class="label">Status</div>
          <div class="value">{{ ucfirst($ekskul->status ?? 'aktif') }}</div>
        </div>
      </div>
    </div>

    <div class="card">
      <h3>Dokumentasi</h3>
      <div class="gallery">
        @php
          $fotoDokumentasi = !empty($ekskul->dokumentasi)
              ? $ekskul->dokumentasi
              : ($ekskul && $ekskul->foto ? [$ekskul->foto, $ekskul->foto, $ekskul->foto] : []);
        @endphp
        @forelse($fotoDokumentasi as $foto)
          <img src="{{ asset('storage/images/'.$foto) }}" alt="Dokumentasi {{ $ekskul->nama ?? 'Marching Band' }}">
        @empty
          <div class="gallery-placeholder">Foto menyusul</div>
          <div class="gallery-placeholder">Foto menyusul</div>
          <div class="gallery-placeholder">Foto menyusul</div>
        @endforelse
      </div>
    </div>

    <div class="actions">
      <a href="https://reg-eskul.smkn1cijati.sch.id/" target="_blank" class="btn primary">Daftar Sekarang</a>
      <a href="{{ url('/') }}" class="btn secondary">Kembali ke Beranda</a>
    </div>

  </div>

  <footer>
    &copy; {{ date('Y') }} {{ $profil->nama_sekolah ?? 'SMK Negeri 1 Cijati' }} — Ekstrakurikuler {{ $ekskul->nama ?? 'Marching Band' }}
  </footer>

</body>
</html>