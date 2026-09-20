<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SMK Negeri 1 Cijati</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="icon" type="image/png" href="{{ isset($profil) && $profil->logo ? asset('storage/images/'.$profil->logo) : asset('images/logo-smkn1cijati.png') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
<div id="alert-box" class="alert" style="display:none;position:fixed;top:20px;right:20px;z-index:9999;padding:12px 18px;border-radius:8px;font-size:13.5px;"></div>

@php
    $daftarEkskulDb = \App\Models\Ekstrakurikuler::where('status', 'aktif')->get();

    $daftarEkskul = $daftarEkskulDb->isNotEmpty()
        ? $daftarEkskulDb->map(function ($ek) {
            $slugRoute = 'ekskul.' . \Illuminate\Support\Str::slug($ek->nama, '');
            return [
                'nama'    => $ek->nama,
                // logo disimpan lewat storeAs('images/ekskul/logo', ...),
                // jadi path publiknya harus diawali 'storage/images/'
                'foto'    => $ek->logo ? 'storage/images/' . $ek->logo : null,
                'route'   => \Illuminate\Support\Facades\Route::has($slugRoute) ? $slugRoute : null,
                'pembina' => optional($ek->pembina)->nama ?? '-',
            ];
        })->all()
        : [
            ['nama' => 'Rohis',        'foto' => 'images/ekskul/rohis.jpg',        'route' => 'ekskul.rohis',        'pembina' => '-'],
            ['nama' => 'Cinemak',      'foto' => 'images/ekskul/cinemak.jpg',      'route' => 'ekskul.cinemak',      'pembina' => '-'],
            ['nama' => 'Voly Bal',     'foto' => 'images/ekskul/voli.jpg',         'route' => 'ekskul.voli',         'pembina' => '-'],
            ['nama' => 'PMR',          'foto' => 'images/ekskul/pmr.jpg',          'route' => 'ekskul.pmr',          'pembina' => '-'],
            ['nama' => 'Karawitan',    'foto' => 'images/ekskul/karawitan.jpg',    'route' => 'ekskul.karawitan',    'pembina' => '-'],
            ['nama' => 'Futsal',       'foto' => 'images/ekskul/futsal.jpg',       'route' => 'ekskul.futsal',       'pembina' => '-'],
            ['nama' => 'Pramuka',      'foto' => 'images/ekskul/pramuka.jpg',      'route' => 'ekskul.pramuka',      'pembina' => '-'],
            ['nama' => 'Paskibra',     'foto' => 'images/ekskul/paskibra.jpg',     'route' => 'ekskul.paskibra',     'pembina' => '-'],
            ['nama' => 'Marchingband', 'foto' => 'images/ekskul/marchingband.jpg', 'route' => 'ekskul.marchingband', 'pembina' => '-'],
            ['nama' => '日本',         'foto' => 'images/ekskul/jepang.jpg',       'route' => 'ekskul.jepang',       'pembina' => '-'],
        ];
@endphp
@php
     $heroSlides = array_filter([
        (isset($profil) && $profil->foto_hero)
            ? asset('storage/images/'.$profil->foto_hero)
            : asset('images/hero/gerbang.jpeg'),

        file_exists(storage_path('app/public/images/hero/panter-sore.jpg'))
            ? asset('storage/images/hero/panter-sore.jpg')
            : null,

        file_exists(storage_path('app/public/images/hero/foto-hormat-senin.jpeg'))
            ? asset('storage/images/hero/foto-hormat-senin.jpeg')
            : null,
    ]);

    $galeriVideoBeranda = (isset($galeriVideo) && $galeriVideo->isNotEmpty())
        ? $galeriVideo->take(6)->map(fn($v) => [
            'judul'      => $v->judul,
            'thumbnail'  => $v->thumbnail
                ? (\Illuminate\Support\Str::startsWith($v->thumbnail, ['http://', 'https://'])
                    ? $v->thumbnail
                    : 'storage/images/video/'.$v->thumbnail)
                : null,
            'youtube_id' => $v->youtube_id ?? null,
            'url'        => $v->url ?? null,
        ])->all()
        : [
            ['judul' => 'Kegiatan Sekolah 1', 'thumbnail' => 'https://img.youtube.com/vi/tnDxcQfZO4c/hqdefault.jpg', 'youtube_id' => 'tnDxcQfZO4c', 'url' => null],
            ['judul' => 'Kegiatan Sekolah 2', 'thumbnail' => 'https://img.youtube.com/vi/597Cegi_KZ0/hqdefault.jpg', 'youtube_id' => '597Cegi_KZ0', 'url' => null],
            ['judul' => 'Kegiatan Sekolah 3', 'thumbnail' => 'https://img.youtube.com/vi/AbIKoCH5MKw/hqdefault.jpg', 'youtube_id' => 'AbIKoCH5MKw', 'url' => null],
            ['judul' => 'Kegiatan Sekolah 4', 'thumbnail' => 'https://img.youtube.com/vi/MV-9TM7J7mQ/hqdefault.jpg', 'youtube_id' => 'MV-9TM7J7mQ', 'url' => null],
            ['judul' => 'Kegiatan Sekolah 5', 'thumbnail' => 'https://img.youtube.com/vi/06UqP1h48m4/hqdefault.jpg', 'youtube_id' => '06UqP1h48m4', 'url' => null],
            ['judul' => 'Kegiatan Sekolah 6', 'thumbnail' => 'https://img.youtube.com/vi/9zLPpbjngew/hqdefault.jpg', 'youtube_id' => '9zLPpbjngew', 'url' => null],
        ];
@endphp
<div class="layout">

  <!-- MAIN -->
  <div class="main">

    <!-- HEADER (hero foto + nav) — tampil di semua halaman -->
    <div class="pv-hero-wrap site-header">
 
      <div class="pv-hero-pill">
        <div class="pv-hero-pill-brand">
          @if(isset($profil) && $profil->logo)
            <img src="{{ asset('storage/images/'.$profil->logo) }}" alt="Logo {{ $profil->nama_sekolah ?? 'Sekolah' }}">
          @else
            <img src="{{ asset('images/logo-smkn1cijati.png') }}" alt="Logo Sekolah">
          @endif
          <div class="pv-hero-pill-brand-text">
            <div class="name">{{ $profil->nama_sekolah ?? 'SMK Negeri 1 Cijati' }}</div>
            <div class="tagline">{{ $profil->moto ?? '" Kompeten, Berkarakter, Siap Kerja "' }}</div>
          </div>
        </div>

        <nav class="pv-hero-pill-menu">
          <a class="menu-item active" data-page="beranda">Beranda</a>

         <a class="menu-item" data-page="profil">Profil Sekolah</a>

          @php
            $routeJurusanNav = ['TKR'=>'jurusan.tkr','PMS'=>'jurusan.pms','PPLG'=>'jurusan.pplg','APHP'=>'jurusan.aphp'];
            $namaKeKodeNav = [
                'Teknik Kendaraan Ringan'=>'TKR',
                'Bisnis Daring dan Pemasaran'=>'PMS','Pemasaran'=>'PMS',
                'Rekayasa Perangkat Lunak'=>'PPLG','Pengembangan Perangkat Lunak dan Gim'=>'PPLG',
                'Agroindustri Pengolahan Hasil Pertanian'=>'APHP','Agriteknologi Pengolahan Hasil Pertanian'=>'APHP',
            ];
            $kodeTampilanNav = [
                'TKR'  => 'TKR',
                'PMS'  => 'PMS',
                'PPLG' => 'PPLG',
                'APHP' => 'APHP',
            ];

          $navJurusanList = ($jurusan ?? collect())->isNotEmpty()
        ? $jurusan->map(function($j) use ($routeJurusanNav, $namaKeKodeNav){
          $nama = $j->nama_jurusan ?? $j->nama ?? '-';
          $kodeRaw = $j->kode ?? ($namaKeKodeNav[$nama] ?? null);
          // FIX: normalisasi supaya "pplg", " PPLG ", "Pplg" tetap cocok
          $kode = $kodeRaw ? strtoupper(trim($kodeRaw)) : null;
          return ['kode'=>$kode, 'nama'=>$nama, 'route'=>$routeJurusanNav[$kode] ?? null];
         })->unique('kode')->values()->all()
                : [
                    ['kode'=>'TKR',  'nama'=>'Teknik Kendaraan Ringan',               'route'=>'jurusan.tkr'],
                    ['kode'=>'PMS',  'nama'=>'Pemasaran',                             'route'=>'jurusan.pms'],
                    ['kode'=>'PPLG', 'nama'=>'Pengembangan Perangkat Lunak dan Gim',  'route'=>'jurusan.pplg'],
                    ['kode'=>'APHP', 'nama'=>'Agriteknologi Pengolahan Hasil Pertanian','route'=>'jurusan.aphp'],
                  ];


                 $prestasiBeranda = (isset($prestasi) && $prestasi->isNotEmpty())
    ? $prestasi->take(3)->map(fn($p) => [
        'judul'   => $p->judul,
        'tanggal' => optional($p->created_at)->translatedFormat('d M Y') ?? '-',
        'foto'    => $p->gambar ? 'storage/images/prestasi/'.$p->gambar : ($p->foto ? 'storage/images/prestasi/'.$p->foto : null),
    ])->all()
    : [
        [
            'judul'   => 'Ilham Sulaeman Dikukuhkan sebagai Pasukan Pengibar Bendera Pusaka Kabupaten Cianjur',
            'tanggal' => '17 Agu 2026',
            'foto'    => 'images/prestasi/ilham-sulaeman-paskibra-kabupaten.jpeg',
        ],
        [
            'judul'   => 'Siti Nurhalimah & Celsa Wisdasari Raih Juara 3 O2SN (Atletik & Bulutangkis Putri)',
            'tanggal' => '20 Agu 2026',
            'foto'    => 'images/prestasi/juara-banbinton.jpeg',
        ],
        [
            'judul'   => 'Regu PMR SMK Negeri 1 Cijati Raih Juara di Kegiatan Perkemahan',
            'tanggal' => '25 Agu 2026',
            'foto'    => 'images/prestasi/pmr-juara1-kabupaten-cianjur .jpg',
        ],
    ];

          @endphp

         <div class="nav-dropdown" id="navDropdownJurusan">
 <a class="menu-item dropdown-toggle" data-page="jurusan" href="#">
    Kompetensi Keahlian
    <span class="dropdown-caret">▾</span>
  </a>
 <div class="nav-dropdown-menu-simple">
    @foreach ($navJurusanList as $j)
      <a class="nav-dropdown-item-simple"
         href="{{ !empty($j['route']) && \Illuminate\Support\Facades\Route::has($j['route']) ? route($j['route']) : url('/') }}">
        <span class="nav-dropdown-item-kode">{{ $kodeTampilanNav[$j['kode']] ?? $j['kode'] }}</span>
        <span class="nav-dropdown-item-nama">{{ $j['nama'] }}</span>
      </a>
    @endforeach
</div>
</div>
          <a class="menu-item" data-page="artikel">Artikel</a>
          <a class="menu-item" data-page="pasilitas">Fasilitas</a>
          <a class="menu-item" data-page="guru">Guru & Staff</a>
          <a class="menu-item" data-page="ekstrakurikuler">Ekstrakurikuler</a>
          <a class="menu-item" data-page="kontak" href="#">Kontak</a>
        </nav>
      </div>

      <div class="pv-hero-banner" id="pvHeroBanner">
        @foreach($heroSlides as $i => $slideUrl)
          <div class="pv-hero-slide {{ $i === 0 ? 'active' : '' }}" style="background-image:url('{{ $slideUrl }}');"></div>
        @endforeach

        <div class="pv-hero-overlay">
          @if(isset($profil) && $profil->logo)
            <img class="pv-hero-logo" src="{{ asset('storage/images/'.$profil->logo) }}" alt="Logo {{ $profil->nama_sekolah ?? 'Sekolah' }}">
          @else
            <img class="pv-hero-logo" src="{{ asset('images/logo-smkn1cijati.png') }}" alt="Logo Sekolah">
          @endif
          <div class="pv-hero-title">{{ $profil->nama_sekolah ?? 'SMK Negeri 1 Cijati' }}</div>
          <div class="pv-hero-tagline">{{ $profil->moto ?? 'SMK Unggulan yang Menghasilkan SDM Bermutu dan Berdaya Saing Tinggi' }}</div>
        </div>
      </div>
    </div>

    <div id="topbarTitle" class="topbar-title-hidden">Beranda <span>/ dashboard</span></div>

    <div class="content">

      <!-- ============ PAGE: BERANDA ============ -->
      <section class="page active" id="page-beranda">

        <div class="pv-section" style="margin-top:28px;">
          <div class="pv-sambutan-grid">
            <div class="pv-sambutan-combined">
              <div class="pv-kepsek-card">
                <div class="pv-kepsek-photo">
                  @if(!empty($kepalaSekolah->foto))
                    <img src="{{ asset('storage/images/'.$kepalaSekolah->foto) }}" alt="{{ $kepalaSekolah->nama }}">
                  @else
                    <div class="pv-placeholder-portrait"></div>
                  @endif
                </div>
                <div class="pv-kepsek-text">
                <div class="pv-kepsek-name">{{ $kepalaSekolah?->nama ?: 'Nama belum diisi' }}</div>
<div class="pv-kepsek-role">{{ $kepalaSekolah?->jabatan ?: 'Kepala Sekolah' }}</div>      </div>
              </div>

              <div class="pv-sambutan-textcard">
                <h2>Sambutan Kepala Sekolah</h2>
                @if(!empty($sambutanKepsek))
                  @foreach(explode("\n\n", $sambutanKepsek) as $paragraf)
                    @if(trim($paragraf) !== '')
                      <p>{{ $paragraf }}</p>
                    @endif
                  @endforeach
                @else
                  <p class="pv-subtext">Sambutan Kepala Sekolah belum diisi.</p>
                @endif
              </div>
            </div>
          </div>
        </div>
@php
    $daftarSeragam = (isset($seragam) && $seragam->isNotEmpty())
        ? $seragam->map(fn($s) => [
            'nama'      => $s->nama,
            'deskripsi' => $s->deskripsi,
            'foto'      => $s->foto ? 'storage/images/beranda/'.$s->foto : null,
        ])->all()
        : [
            [
                'nama' => 'Senin & Selasa',
                'deskripsi' => 'Seragam resmi yang digunakan siswa-siswi SMK Negeri 1 Cijati pada hari Senin dan Selasa, yaitu seragam putih-abu lengkap dengan atribut OSIS, dasi, dan sepatu hitam.',
                'foto' => 'images/beranda/seragam-senin-selasa.jpeg',
            ],
            [
                'nama' => 'Olahraga',
                'deskripsi' => 'Seragam resmi yang digunakan siswa-siswi SMK Negeri 1 Cijati saat kegiatan PJOK, yaitu seragam olahraga berwarna biru lengkap dengan kaos, celana training, dan sepatu olahraga.',
                'foto' => 'images/beranda/seragam-olahraga.jpeg',
            ],
            [
                'nama' => 'Korep',
                'deskripsi' => 'Seragam resmi yang digunakan siswa-siswi SMK Negeri 1 Cijati pada hari tertentu, yaitu seragam korep berwarna biru muda lengkap dengan lencana valuet dan sepatu hitam.',
                'foto' => 'images/beranda/seragam-rabu.jpeg',
            ],
            [
                'nama' => 'Kamis',
                'deskripsi' => 'Seragam resmi yang digunakan siswa-siswi SMK Negeri 1 Cijati pada hari Kamis, yaitu seragam batik khas sekolah lengkap dengan rok/celana abu tua dan sepatu hitam.',
                'foto' => 'images/beranda/seragam-kamis.jpeg',
            ],
            [
                'nama' => "Jum'at",
                'deskripsi' => "Seragam resmi yang digunakan siswa-siswi SMK Negeri 1 Cijati pada hari Jum'at, yaitu seragam Pramuka lengkap dengan kacu merah putih dan sepatu hitam.",
                'foto' => 'images/beranda/seragam-jumat.jpeg',
            ],
        ];
@endphp

<div class="pv-section" style="margin-top:28px;">
  <div class="pv-prestasi-header">
    <h2 class="pv-prestasi-title">Seragam Sekolah</h2>
    <p class="pv-subtext" style="margin:-6px 0 0;">Ketentuan seragam harian siswa-siswi {{ $profil->nama_sekolah ?? 'SMK Negeri 1 Cijati' }}</p>
  </div>
 <div class="pv-seragam-carousel-wrap">
  <button type="button" class="pv-seragam-nav-btn" id="seragamPrev" aria-label="Sebelumnya">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="m15 18-6-6 6-6"/></svg>
  </button>

  <div class="pv-seragam-track" id="seragamTrack">
    @foreach($daftarSeragam as $s)
      <div class="pv-fasilitas-card pv-seragam-card">
        <div class="pv-fasilitas-photo">
          <img src="{{ asset($s['foto']) }}" alt="Seragam {{ $s['nama'] }}" data-lightbox style="cursor:zoom-in;"
               onerror="this.closest('.pv-fasilitas-photo').innerHTML='<div class=&quot;pv-placeholder-img&quot;></div>';">
        </div>
        <div class="pv-fasilitas-body">
          <div class="pv-fasilitas-name">{{ $s['nama'] }}</div>
          <div class="pv-fasilitas-desc">{{ $s['deskripsi'] }}</div>
        </div>
      </div>
    @endforeach
  </div>

  <button type="button" class="pv-seragam-nav-btn" id="seragamNext" aria-label="Berikutnya">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="m9 18 6-6-6-6"/></svg>
  </button>
</div>

       

        {{-- ===== Artikel Terbaru ===== --}}
<div class="pv-section" style="margin-top:28px;">
  <div class="pv-prestasi-header">
    <h2 class="pv-prestasi-title">Artikel Terbaru</h2>
    <p class="pv-subtext" style="margin:-6px 0 0;">Kabar dan kegiatan terbaru dari {{ $profil->nama_sekolah ?? 'SMK Negeri 1 Cijati' }}</p>
    <a href="#" class="menu-item pv-prestasi-viewall" data-page="artikel">
      Lihat Semua Berita →
    </a>
  </div>

  <div class="pv-artikel-beranda-grid">
    @forelse($artikelBeranda as $a)
      <div class="pv-artikel-beranda-card">
        <div class="pv-artikel-beranda-photo">
          @if($a['foto'] ?? false)
            <img src="{{ asset($a['foto']) }}" alt="{{ $a['judul'] }}" data-lightbox
                 onerror="this.closest('.pv-artikel-beranda-photo').innerHTML='<div class=&quot;pv-placeholder-img&quot;></div>';">
          @else
            <div class="pv-placeholder-img"></div>
          @endif
        </div>
        <div class="pv-artikel-beranda-body">
          <div class="pv-artikel-beranda-date">{{ $a['tanggal'] }}</div>
          <div class="pv-artikel-beranda-title">{{ $a['judul'] }}</div>
          <div class="pv-artikel-beranda-excerpt">{{ $a['excerpt'] }}</div>
          <a href="#" class="pv-link menu-item" data-page="artikel">Selengkapnya</a>
        </div>
      </div>
    @empty
      <p class="pv-subtext">Belum ada artikel.</p>
    @endforelse
  </div>
</div>
    {{-- ===== Galeri Video ===== --}}
<div class="pv-section" style="margin-top:28px;">
  <div class="pv-prestasi-header">
    <h2 class="pv-prestasi-title">Galeri Video</h2>
    <p class="pv-subtext" style="margin:-6px 0 0;">Dokumentasi video kegiatan {{ $profil->nama_sekolah ?? 'SMK Negeri 1 Cijati' }}</p>
    <a href="https://www.youtube.com/@smkn1cijatiofficial" target="_blank" rel="noopener noreferrer"
       class="pv-prestasi-viewall">
      Tampilkan Selengkapnya →
    </a>
  </div>

  <div class="pv-galeri-video-grid">
    @forelse($galeriVideoBeranda as $v)
      <div class="pv-galeri-video-card"
           data-video-youtube="{{ $v['youtube_id'] ?? '' }}"
           data-video-url="{{ $v['url'] ?? '' }}"
           data-video-title="{{ $v['judul'] }}">
      @if($v['thumbnail'] ?? false)
 <img src="{{ \Illuminate\Support\Str::startsWith($v['thumbnail'], ['http://', 'https://']) ? $v['thumbnail'] : asset($v['thumbnail']) }}"
     alt="{{ $v['judul'] }}"
     onerror="this.outerHTML='<div class=&quot;pv-placeholder-img&quot;></div>';">
@else
  <div class="pv-placeholder-img"></div>
@endif
        <div class="pv-galeri-video-overlay"></div>
        <button type="button" class="pv-galeri-video-play" aria-label="Putar video" tabindex="-1">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
        </button>
        <div class="pv-galeri-video-title">{{ $v['judul'] }}</div>
      </div>
    @empty
      <p class="pv-subtext">Belum ada galeri video.</p>
    @endforelse
  </div>
</div>

{{-- ===== Prestasi ===== --}}
<div class="pv-section" style="margin-top:28px;">
  <div class="pv-prestasi-header">
    <h2 class="pv-prestasi-title">Prestasi</h2>
    <a href="#" class="pv-prestasi-viewall menu-item" data-page="artikel">Lihat Semua Prestasi →</a>
  </div>

  <div class="pv-prestasi-grid">
    @forelse($prestasiBeranda as $a)
      <div class="pv-prestasi-card">
        <div class="pv-prestasi-photo">
          @if($a['foto'] ?? false)
            <img src="{{ asset($a['foto']) }}" alt="{{ $a['judul'] }}" data-lightbox
                 onerror="this.closest('.pv-prestasi-photo').innerHTML='<div class=&quot;pv-placeholder-img&quot;></div>';">
          @else
            <div class="pv-placeholder-img"></div>
          @endif
        </div>
        <div class="pv-prestasi-body">
          <div class="pv-prestasi-label">Berita Prestasi</div>
          <div class="pv-prestasi-judul">{{ $a['judul'] }}</div>
          <div class="pv-prestasi-date">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
            {{ $a['tanggal'] }}
          </div>
        </div>
      </div>
    @empty
      <p class="pv-subtext">Belum ada prestasi.</p>
    @endforelse
  </div>
</div>

{{-- ===== Statistik Sekolah ===== --}}
<div class="pv-section" style="margin-top:28px;">
  <div class="pv-statistik-card">
    <div class="pv-artikel-stat-header">
      <h3 class="pv-artikel-stat-title">📊 Statistik Sekolah</h3>
      <p class="pv-artikel-stat-subtitle">Data singkat dan capaian sekolah</p>
    </div>

    <div class="pv-artikel-stat-grid">
      <div class="pv-artikel-stat-card pv-stat-blue">
        <div class="pv-artikel-stat-icon">🎓</div>
        <div class="pv-artikel-stat-value" data-count-target="721">0</div>
        <div class="pv-artikel-stat-label">Jumlah Siswa</div>
      </div>

      <div class="pv-artikel-stat-card pv-stat-teal">
        <div class="pv-artikel-stat-icon">👩‍🏫</div>
        <div class="pv-artikel-stat-value" data-count-target="51">0</div>
        <div class="pv-artikel-stat-label">Jumlah Guru</div>
      </div>

      <div class="pv-artikel-stat-card pv-stat-amber">
        <div class="pv-artikel-stat-icon">🏅</div>
        <div class="pv-artikel-stat-value" data-count-target="{{ count($daftarEkskul) }}">0</div>
        <div class="pv-artikel-stat-label">Ekstrakurikuler</div>
      </div>

      <div class="pv-artikel-stat-card pv-stat-purple">
        <div class="pv-artikel-stat-icon">📚</div>
        <div class="pv-artikel-stat-value" data-count-target="{{ count($navJurusanList) }}">0</div>
        <div class="pv-artikel-stat-label">Jurusan</div>
      </div>
    </div>
  </div>
</div>

</section>

      <!-- ============ PAGE: PROFIL SEKOLAH ============ -->
<section class="page" id="page-profil">
<div class="pv-section pv-about-section">
  <div class="pv-about-grid pv-about-grid-tall">
    <div class="pv-about-photo-wrap pv-about-photo-wrap-tall">
      <div class="pv-about-badge-main">{{ $profil->nama_sekolah ?? 'SMK Negeri 1 Cijati' }}</div>
      <div class="pv-about-badge-sub">Gerbang Sekolah</div>
      <img src="{{ isset($profil) && $profil->foto_sambutan ? asset('storage/images/'.$profil->foto_sambutan) : asset('images/smkn1cijati.jpg') }}"
           alt="{{ $profil->nama_sekolah ?? 'SMK Negeri 1 Cijati' }}"
           class="pv-about-photo">
    </div>

    <div class="pv-about-content pv-about-content-stack">
      <!-- ---- Sejarah + Visi & Misi (satu kartu) ---- -->
      <div class="pv-sambutan-textcard">
        <h2>Sejarah</h2>
        <p>{{ $profil->sejarah ?? 'Sejarah sekolah belum diisi.' }}</p>

        <h2 style="margin-top:26px;">Visi &amp; Misi</h2>
        <p><strong>Visi</strong><br>
          {{ $profil->visi ?? 'Visi sekolah belum diisi.' }}
        </p>
        <p style="margin-bottom:6px;"><strong>Misi</strong></p>
        <ul>
          @forelse($profil->misi ?? [] as $misi)
            <li>{{ $misi }}</li>
          @empty
            <li>Belum ada data misi.</li>
          @endforelse
        </ul>
      </div>
    </div>
  </div>
</div>
</section>
       
      <!-- ============ PAGE: ARTIKEL ============ -->
      <section class="page" id="page-artikel">
        @php
          $daftarArtikel = ($artikel ?? collect())->isNotEmpty()
              ? $artikel->map(fn($b) => [
                  'judul'   => $b->judul,
                  'tanggal' => optional($b->created_at)->translatedFormat('d M Y') ?? '-',
                  'excerpt' => \Illuminate\Support\Str::limit(strip_tags($b->ringkasan ?? $b->konten ?? $b->isi ?? ''), 110),
                  'foto'    => $b->gambar ? 'storage/images/artikel/'.$b->gambar : ($b->foto ? 'storage/images/artikel/'.$b->foto : null),
              ])->all()
              : [
                  ['judul' => 'Konsentrasi Keahlian APHP — Agribisnis Pengolahan Hasil Pertanian', 'tanggal' => '30 Agu 2026', 'excerpt' => 'Mengenal program keahlian Agribisnis Pengolahan Hasil Pertanian (APHP): belajar mengolah hasil pertanian jadi produk bernilai jual hingga prospek karier alumninya.', 'foto' => 'images/artikel/brosur-aphp.jpeg'],
                  ['judul' => 'Rekap Ekskul Mingguan — Satu Nada Satu Jiwa', 'tanggal' => '29 Agu 2026', 'excerpt' => 'Rekap kegiatan ekstrakurikuler mingguan SMK Negeri 1 Cijati di RPS TKR, mengangkat semangat "Satu Nada Satu Jiwa".', 'foto' => 'images/artikel/rekap-ekskul-mingguan.jpeg'],
                  ['judul' => 'Kelengkapan Kelas — Kelas Nyaman, Belajar Menyenangkan', 'tanggal' => '28 Agu 2026', 'excerpt' => 'Panduan kelengkapan kelas SMK Negeri 1 Cijati agar proses belajar mengajar berjalan efektif, tertib, dan menyenangkan.', 'foto' => 'images/artikel/kelengkapan-kelas.jpeg'],
                  ['judul' => 'Penutupan MPLS Pancawaluya', 'tanggal' => '27 Agu 2026', 'excerpt' => 'Rangkaian Masa Pengenalan Lingkungan Sekolah (MPLS) Pancawaluya resmi ditutup pada Selasa, 22 Juli 2026.', 'foto' => 'images/artikel/penutupan-mpls-pancawaluya.jpeg'],
                  ['judul' => 'Program Keahlian & Ekstrakurikuler SMK Negeri 1 Cijati', 'tanggal' => '26 Agu 2026', 'excerpt' => 'Sekilas program keahlian dan peluang karier lulusan, serta daftar ekstrakurikuler yang bisa diikuti siswa SMK Negeri 1 Cijati.', 'foto' => 'images/artikel/program-keahlian-ekstrakurikuler.jpeg'],
                  ['judul' => 'Konsentrasi Keahlian Pemasaran — Bisnis Digital & Bisnis Ritel', 'tanggal' => '25 Agu 2026', 'excerpt' => 'Mengenal program keahlian Bisnis Digital dan Bisnis Ritel (Pemasaran): jualan online, strategi promosi media sosial, hingga jejak karier alumni.', 'foto' => 'images/artikel/brosur-pemasaran-bd.jpeg'],
                  ['judul' => 'SEHATI — Selasa Sehat Siswa-Siswi SMKN 1 Cijati', 'tanggal' => '24 Agu 2026', 'excerpt' => 'Program Senam Pagi rutin setiap hari Selasa untuk menjaga kebugaran dan kesehatan siswa-siswi SMK Negeri 1 Cijati.', 'foto' => 'images/artikel/senam-pagi-sehati.jpeg'],
                  ['judul' => 'MPLS Pancawaluya — Hari ke-5', 'tanggal' => '23 Agu 2026', 'excerpt' => 'Siswa baru mengikuti kegiatan gotong royong membersihkan lingkungan dan selokan sekitar sekolah pada hari kelima MPLS Pancawaluya.', 'foto' => 'images/artikel/mpls-pancawaluya-day5.jpeg'],
                  ['judul' => 'Upacara Memperingati HUT Ke-81 Republik Indonesia', 'tanggal' => '22 Agu 2026', 'excerpt' => 'Upacara memperingati HUT ke-81 Republik Indonesia digelar khidmat dengan Kepala Sekolah bertindak sebagai pembina upacara.', 'foto' => 'images/artikel/upacara-hut-81-ri.jpeg'],
                  ['judul' => 'Pengukuhan Pasukan Pengibar Bendera Kecamatan Cijati', 'tanggal' => '21 Agu 2026', 'excerpt' => '14 perwakilan SMK Negeri 1 Cijati resmi dikukuhkan sebagai Pasukan Pengibar Bendera (Paskibra) tingkat Kecamatan Cijati.', 'foto' => 'images/artikel/pengukuhan-paskibra-kecamatan.jpeg'],
                  ['judul' => 'Konsentrasi Keahlian TKR — Teknik Kendaraan Ringan', 'tanggal' => '20 Agu 2026', 'excerpt' => 'Mengenal program keahlian Teknik Kendaraan Ringan (TKR): materi pembelajaran, praktik perbengkelan, hingga jejak karier para alumninya.', 'foto' => 'images/artikel/brosur-tkr.jpeg'],
                  ['judul' => 'Dirgahayu Republik Indonesia ke-81', 'tanggal' => '19 Agu 2026', 'excerpt' => 'Segenap keluarga besar SMK Negeri 1 Cijati menyampaikan ucapan Dirgahayu Republik Indonesia ke-81, 17 Agustus 2026.', 'foto' => 'images/artikel/dirgahayu-ri-81.jpeg'],
                  ['judul' => 'Ilham Sulaeman, Paskibra Pusaka Kabupaten Cianjur', 'tanggal' => '18 Agu 2026', 'excerpt' => 'Selamat dan sukses kepada Ilham Sulaeman, siswa SMK Negeri 1 Cijati, atas pengukuhannya sebagai Pasukan Pengibar Bendera Pusaka tingkat Kabupaten Cianjur.', 'foto' => 'images/artikel/ilham-sulaeman-paskibra-kabupaten.jpeg'],
                  ['judul' => 'MPLS Pancawaluya — Hari ke-2', 'tanggal' => '17 Agu 2026', 'excerpt' => 'Rangkaian Masa Pengenalan Lingkungan Sekolah (MPLS) Pancawaluya hari kedua diisi dengan pemeriksaan kesehatan bagi seluruh siswa baru.', 'foto' => 'images/artikel/mpls-pancawaluya-day2.jpeg'],
                  ['judul' => 'Upacara Peringatan Hari Pramuka ke-65', 'tanggal' => '16 Agu 2026', 'excerpt' => 'Upacara memperingati Hari Pramuka ke-65 pada 14 Agustus 2026 diikuti seluruh siswa sebagai wujud semangat kepramukaan.', 'foto' => 'images/artikel/upacara-hari-pramuka.jpeg'],
                  ['judul' => 'Konsentrasi Keahlian PPLG — Rekayasa Perangkat Lunak', 'tanggal' => '15 Agu 2026', 'excerpt' => 'Mengenal program keahlian Pengembangan Perangkat Lunak dan Gim (PPLG): belajar coding, desain UI/UX, hingga prospek karier alumni di bidang IT.', 'foto' => 'images/artikel/brosur-pplg.jpeg'],
                  ['judul' => 'Program Keahlian SMK Negeri 1 Cijati', 'tanggal' => '14 Agu 2026', 'excerpt' => 'Sekilas tentang program-program keahlian yang tersedia di SMK Negeri 1 Cijati sebagai bekal siswa menuju dunia kerja dan industri.', 'foto' => 'images/artikel/program-keahlian-smkn1cijati.jpeg'],
                  ['judul' => 'Seragam Harian Siswa-Siswi SMKN 1 Cijati', 'tanggal' => '13 Agu 2026', 'excerpt' => 'Ketentuan seragam harian siswa-siswi untuk hari Senin sampai Jumat, mulai dari seragam formal, pramuka, hingga pakaian olahraga.', 'foto' => 'images/artikel/foto-seragam.jpeg'],
                  ['judul' => 'Panter Vol 2 — Pendidikan Akhlak dan Karakter', 'tanggal' => '11 Agu 2026', 'excerpt' => 'Program Panter Volume 2 kembali digelar bekerja sama dengan TNI AD untuk membentuk disiplin dan mental siswa.', 'foto' => 'images/artikel/panter-vol-2_22.jpg'],
                  ['judul' => 'Panter Vol 2 — Sambutan Pembina Kegiatan', 'tanggal' => '09 Agu 2026', 'excerpt' => 'Rangkaian kegiatan Panter Vol 2 turut dihadiri jajaran pembina dan pelatih dari TNI AD sebagai bentuk sinergi dengan aparat setempat.', 'foto' => 'images/artikel/panter-vol2.jpg'],
                  ['judul' => 'Upacara Bendera di Lingkungan RPS TKR', 'tanggal' => '07 Agu 2026', 'excerpt' => 'Kegiatan upacara bendera rutin diikuti siswa-siswi sebagai bentuk penanaman rasa nasionalisme dan kedisiplinan.', 'foto' => 'images/artikel/poto-upacara.jpg'],
                  ['judul' => 'Pesantren Ekologi 2026', 'tanggal' => '05 Agu 2026', 'excerpt' => 'Bersih hati, bersih badan, bersih lingkungan — sekolah menggelar Pesantren Ekologi untuk menumbuhkan kepedulian siswa terhadap lingkungan.', 'foto' => 'images/artikel/psantren-ekologi-2026.jpg'],
                  ['judul' => 'Relasi: Rabu Literasi', 'tanggal' => '03 Agu 2026', 'excerpt' => 'Program Rabu Literasi menjadi agenda rutin untuk menumbuhkan minat baca siswa dan guru di sekolah yang telah terakreditasi A.', 'foto' => 'images/artikel/relasi.jpg'],
                  ['judul' => 'Pembinaan Wawasan Kebangsaan bagi Siswa Baru', 'tanggal' => '15 Agu 2026', 'excerpt' => 'Siswa baru mengikuti pembinaan wawasan kebangsaan sebagai bagian dari pengenalan lingkungan sekolah.', 'foto' => 'images/artikel/foto-seragam.jpeg'],
                  ['judul' => 'Panter Vol 2: Materi Bela Negara dari TNI AD', 'tanggal' => '13 Agu 2026', 'excerpt' => 'Materi bela negara disampaikan langsung oleh personel TNI AD dalam rangkaian Panter Vol 2.', 'foto' => 'images/artikel/panter-vol-2_22.jpg'],
                  ['judul' => 'Sinergi TNI dan Sekolah dalam Program Panter', 'tanggal' => '11 Agu 2026', 'excerpt' => 'Kerja sama sekolah dengan TNI AD terus berlanjut lewat program pembinaan karakter Panter.', 'foto' => 'images/artikel/panter-vol2.jpg'],
                  ['judul' => 'Upacara Peringatan Hari Pendidikan Nasional', 'tanggal' => '09 Agu 2026', 'excerpt' => 'Upacara khidmat digelar untuk memperingati Hari Pendidikan Nasional di lapangan sekolah.', 'foto' => 'images/artikel/poto-upacara.jpg'],
                  ['judul' => 'Aksi Peduli Lingkungan Warga Sekolah', 'tanggal' => '07 Agu 2026', 'excerpt' => 'Warga sekolah bergotong royong membersihkan lingkungan sebagai wujud kepedulian terhadap ekologi.', 'foto' => 'images/artikel/psantren-ekologi-2026.jpg'],
                  ['judul' => 'Gerakan Literasi Sekolah Setiap Rabu', 'tanggal' => '05 Agu 2026', 'excerpt' => 'Kegiatan literasi mingguan terus konsisten dijalankan untuk membiasakan siswa gemar membaca.', 'foto' => 'images/bartikel/relasi.jpg'],
                  ['judul' => 'Sosialisasi Tata Tertib dan Seragam Sekolah', 'tanggal' => '03 Agu 2026', 'excerpt' => 'Sosialisasi tata tertib dan ketentuan seragam disampaikan kepada seluruh siswa di awal tahun ajaran.', 'foto' => 'images/artikel/foto-seragam.jpeg'],
                  ['judul' => 'Latihan Fisik dan Mental Siswa dalam Panter Vol 2', 'tanggal' => '01 Agu 2026', 'excerpt' => 'Latihan fisik dan mental menjadi bagian penting dalam pembentukan karakter siswa pada Panter Vol 2.', 'foto' => 'images/artikel/panter-vol-2_22.jpg'],
                  ['judul' => 'Penutupan Kegiatan Panter Vol 2', 'tanggal' => '30 Jul 2026', 'excerpt' => 'Rangkaian kegiatan Panter Vol 2 resmi ditutup dengan apresiasi kepada seluruh peserta.', 'foto' => 'images/artikel/panter-vol2.jpg'],
                  ['judul' => 'Upacara Rutin Hari Senin', 'tanggal' => '28 Jul 2026', 'excerpt' => 'Upacara bendera rutin setiap hari Senin tetap konsisten dijalankan sebagai pembiasaan disiplin.', 'foto' => 'images/artikel/poto-upacara.jpg'],
                  ['judul' => 'Edukasi Pengelolaan Sampah di Lingkungan Sekolah', 'tanggal' => '26 Jul 2026', 'excerpt' => 'Siswa diberikan edukasi tentang pemilahan dan pengelolaan sampah yang baik di lingkungan sekolah.', 'foto' => 'images/artikel/psantren-ekologi-2026.jpg'],
                  ['judul' => 'Kunjungan Perpustakaan Keliling', 'tanggal' => '24 Jul 2026', 'excerpt' => 'Perpustakaan keliling hadir di sekolah untuk memperkaya koleksi bacaan yang bisa diakses siswa.', 'foto' => 'images/artikel/relasi.jpg'],
                  ['judul' => 'Ketentuan Seragam Olahraga Siswa', 'tanggal' => '22 Jul 2026', 'excerpt' => 'Ketentuan pemakaian seragam olahraga disosialisasikan kembali menjelang kegiatan PJOK.', 'foto' => 'images/artikel/foto-seragam.jpeg'],
                  ['judul' => 'Character Building Bersama TNI AD', 'tanggal' => '20 Jul 2026', 'excerpt' => 'Kegiatan character building bersama TNI AD bertujuan menumbuhkan jiwa kepemimpinan siswa.', 'foto' => 'images/artikel/panter-vol-2_22.jpg'],
                  ['judul' => 'Apresiasi untuk Peserta Panter Vol 2 Terbaik', 'tanggal' => '18 Jul 2026', 'excerpt' => 'Penghargaan diberikan kepada peserta terbaik dalam rangkaian kegiatan Panter Vol 2.', 'foto' => 'images/artikel/panter-vol2.jpg'],
                  ['judul' => 'Upacara Peringatan HUT Kemerdekaan RI', 'tanggal' => '16 Jul 2026', 'excerpt' => 'Seluruh warga sekolah mengikuti upacara peringatan Hari Kemerdekaan Republik Indonesia.', 'foto' => 'images/artikel/poto-upacara.jpg'],
                  ['judul' => 'Penanaman Pohon di Area Sekolah', 'tanggal' => '14 Jul 2026', 'excerpt' => 'Kegiatan penanaman pohon dilaksanakan sebagai bagian dari program Pesantren Ekologi sekolah.', 'foto' => 'images/artikel/psantren-ekologi-2026.jpg'],
                  ['judul' => 'Bedah Buku Bersama Siswa dan Guru', 'tanggal' => '12 Jul 2026', 'excerpt' => 'Kegiatan bedah buku digelar untuk mendorong budaya diskusi dan literasi di kalangan siswa.', 'foto' => 'images/artikel/relasi.jpg'],
                  ['judul' => 'Seragam Batik Sekolah untuk Hari Kamis', 'tanggal' => '10 Jul 2026', 'excerpt' => 'Penggunaan seragam batik khas sekolah diwajibkan setiap hari Kamis bagi seluruh siswa.', 'foto' => 'images/artikel/foto-seragam.jpeg'],
                  ['judul' => 'Simulasi Kedisiplinan ala TNI dalam Panter Vol 2', 'tanggal' => '08 Jul 2026', 'excerpt' => 'Simulasi baris-berbaris dan kedisiplinan ala TNI menjadi salah satu materi favorit siswa di Panter Vol 2.', 'foto' => 'images/artikel/panter-vol-2_22.jpg'],
                  ['judul' => 'Testimoni Siswa Peserta Panter Vol 2', 'tanggal' => '06 Jul 2026', 'excerpt' => 'Sejumlah siswa membagikan kesan dan pengalaman positif setelah mengikuti kegiatan Panter Vol 2.', 'foto' => 'images/artikel/panter-vol2.jpg'],
              ];

          $artikelPerHalaman = 4;
          $totalHalamanArtikel = (int) ceil(count($daftarArtikel) / $artikelPerHalaman);
        @endphp

        <div class="pv-section">
  <div class="pv-prestasi-header">
    <h2 class="pv-prestasi-title">Artikel</h2>
    <a href="#" class="pv-prestasi-viewall" id="artikelViewAllBtn">Lihat Semua Berita →</a>
  </div>

  <div class="pv-artikel-grid-wrap">
            <div class="pv-artikel-list pv-artikel-list-paged" id="artikelList">
              @forelse($daftarArtikel as $i => $b)
                <div class="pv-artikel-card" data-page="{{ intdiv($i, $artikelPerHalaman) + 1 }}" @if($i >= $artikelPerHalaman) style="display:none;" @endif>
                  <div class="pv-artikel-photo-wrap">
                    @if($b['foto'] ?? false)
                      <img src="{{ asset($b['foto']) }}" alt="{{ $b['judul'] }}"
                           class="pv-artikel-photo-main"
                           data-lightbox
                           onerror="this.outerHTML='<div class=&quot;pv-placeholder-img&quot;></div>';">
                    @else
                      <div class="pv-placeholder-img"></div>
                    @endif
                  </div>
                  <div class="pv-artikel-date-row">{{ $b['tanggal'] }}</div>
                  <div class="pv-artikel-title">{{ $b['judul'] }}</div>
                  <div class="pv-artikel-excerpt">{{ $b['excerpt'] }}</div>
                  <a href="#" class="pv-link">Selengkapnya</a>
                </div>
              @empty
                <p class="pv-subtext">Belum ada artikel.</p>
              @endforelse
            </div>

            @if($totalHalamanArtikel > 1)
              <div class="pv-artikel-nav" id="artikelNav" data-total="{{ $totalHalamanArtikel }}">
                <button type="button" class="pv-artikel-nav-btn" id="artikelPrev" aria-label="Artikel sebelumnya">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="m15 18-6-6 6-6"/></svg>
                </button>
                <div class="pv-artikel-numbers" id="artikelDots">
                  @for($p = 1; $p <= $totalHalamanArtikel; $p++)
                    <button type="button" class="pv-artikel-num {{ $p === 1 ? 'active' : '' }}" data-page="{{ $p }}">{{ $p }}</button>
                  @endfor
                </div>
                <button type="button" class="pv-artikel-nav-btn" id="artikelNext" aria-label="Artikel selanjutnya">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="m9 18 6-6-6-6"/></svg>
                </button>
              </div>
            @endif
          </div>
        </div>

        <div class="pv-section" style="margin-top:34px;">
          <h3 class="pv-subtitle">Agenda</h3>
          @php
            $daftarAgenda = ($agenda ?? collect())->isNotEmpty()
                ? $agenda->map(fn($a) => [
                    'd' => $a->tanggal->format('d'),
                    'm' => strtoupper($a->tanggal->translatedFormat('M')),
                    't' => $a->judul,
                    's' => $a->keterangan ?? '',
                ])->all()
                : [
                    ['d' => '14', 'm' => 'AGU', 't' => 'Upacara HUT RI ke-81', 's' => 'Lapangan utama sekolah'],
                    ['d' => '22', 'm' => 'AGU', 't' => 'Rapat Orang Tua Siswa', 's' => 'Aula sekolah'],
                    ['d' => '30', 'm' => 'AGU', 't' => 'Ujian Tengah Semester', 's' => 'Seluruh kelas'],
                ];
          @endphp
          <div class="pv-agenda-panel" style="max-width:520px;">
            @forelse($daftarAgenda as $a)
              <div class="pv-agenda-item">
                <div class="pv-agenda-date">
                  <div class="d">{{ $a['d'] }}</div>
                  <div class="m">{{ $a['m'] }}</div>
                </div>
                <div class="pv-agenda-text">
                  <div class="t">{{ $a['t'] }}</div>
                  <div class="s">{{ $a['s'] }}</div>
                </div>
              </div>
            @empty
              <p class="pv-subtext">Belum ada agenda.</p>
            @endforelse
          </div>
        </div>
      </section>

      <!-- ============ PAGE: PASILITAS ============ -->
      <section class="page" id="page-pasilitas">
        @php
          $daftarFasilitas = ($fasilitas ?? collect())->isNotEmpty()
    ? $fasilitas->map(fn($f) => [
        'nama'      => $f->nama_fasilitas,
        'deskripsi' => $f->deskripsi ?? '-',
        'foto'      => $f->gambar ? 'storage/images/pasilitas/'.$f->gambar : null,
    ])->all()
    : [
                 
                  [
                      'nama' => 'RPS TKR',
                      'deskripsi' => 'Ruang Praktik Siswa (RPS) jurusan Teknik Kendaraan Ringan, dilengkapi fasilitas untuk kegiatan praktik dan pembelajaran otomotif.',
                      'foto' => 'images/pasilitas/rps.jpeg',
                  ],
                  [
                      'nama' => 'Ruang Guru',
                      'deskripsi' => 'Ruang kerja para guru untuk menyiapkan bahan ajar, berdiskusi, dan beristirahat di luar jam mengajar.',
                      'foto' => 'images/pasilitas/ruang guru.jpeg',
                  ],
                  [
                      'nama' => 'Ruang Bimbingan & Konseling',
                      'deskripsi' => 'Ruang layanan Bimbingan dan Konseling (BK) bagi siswa untuk konsultasi akademik maupun pribadi.',
                      'foto' => 'images/pasilitas/ruang-bk.jpeg',
                  ],
                  [
                      'nama' => 'Laboratorium RPL',
                      'deskripsi' => 'Ruang praktik siswa jurusan Rekayasa Perangkat Lunak dan Gim (PPLG/RPL), dilengkapi unit komputer untuk kegiatan pemrograman dan pengembangan perangkat lunak.',
                      'foto' => 'images/pasilitas/leb-rpl.JPG',
                  ],
                  [
                      'nama' => 'Laboratorium APHP',
                      'deskripsi' => 'Workshop Agroindustri Pengolahan Hasil Pertanian (APHP), tempat siswa mempraktikkan pengolahan dan pengemasan produk pangan menggunakan mesin produksi.',
                      'foto' => 'images/pasilitas/leb-aphp.JPG',
                  ],
                  [
                      'nama' => 'Laboratorium BDP',
                      'deskripsi' => 'Ruang praktik Bisnis Daring dan Pemasaran (BDP), tempat siswa mengelola booth penjualan dan berlatih pemasaran produk secara langsung.',
                      'foto' => 'images/pasilitas/leb-bdp.JPG',
                  ],
                  [
                      'nama' => 'Mushola',
                      'deskripsi' => 'Tempat ibadah bagi warga sekolah.',
                      'foto' => 'images/pasilitas/musola_2_3.JPG',
                  ],
              ];
        @endphp

        <div class="pv-section">
          <h2 class="pv-title">Fasilitas</h2>
          <p class="pv-subtext">Sarana dan prasarana penunjang kegiatan belajar di {{ $profil->nama_sekolah ?? 'SMK Negeri 1 Cijati' }}.</p>

          <div class="pv-fasilitas-grid">
            @forelse($daftarFasilitas as $f)
              <div class="pv-fasilitas-card">
                <div class="pv-fasilitas-photo">
                  @if($f['foto'] ?? false)
                    <img src="{{ asset($f['foto']) }}" alt="{{ $f['nama'] }}" data-lightbox style="cursor:zoom-in;">
                  @else
                    <div class="pv-placeholder-img"></div>
                  @endif
                </div>
                <div class="pv-fasilitas-body">
                  <div class="pv-fasilitas-name">{{ $f['nama'] }}</div>
                  <div class="pv-fasilitas-desc">{{ $f['deskripsi'] }}</div>
                </div>
              </div>
            @empty
              <p class="pv-subtext">Belum ada data fasilitas.</p>
            @endforelse
          </div>
        </div>
      </section>

      <!-- ============ PAGE: GURU ============ -->
      <section class="page" id="page-guru">
        <div class="pv-guru-header">
          <h2 class="pv-title" style="display:block;text-align:center;">Pegawai</h2>
          <p class="pv-subtext" style="text-align:center;">Pendidik dan Tenaga Kependidikan {{ $profil->nama_sekolah ?? 'SMK Negeri 1 Cijati' }}</p>
        </div>

        @php
          $daftarGuruAdmin = ($guru ?? collect())->isNotEmpty() ? null : [
              ['nama' => 'Ahmad Suhendra',                    'mapel' => 'Kebersihan & Keindahan Sekolah', 'jurusan' => '-', 'foto' => 'ahmad_suhendra.jpg'],
              ['nama' => 'Ai Nurhasanah, S.Pd.',              'mapel' => 'Matematika & Informatika',       'jurusan' => '-', 'foto' => 'ai_nurhasanah.jpg'],
              ['nama' => 'Andri Muhoir, S.T.',                'mapel' => 'Teknik Otomotif',                 'jurusan' => '-', 'foto' => 'andri_muhoir.jpg'],
              ['nama' => 'Apendi',                            'mapel' => 'Kebersihan & Keindahan Sekolah', 'jurusan' => '-', 'foto' => 'apendi.jpg'],
              ['nama' => 'Asep Muhlis Sulaeman, S.Pd.I.',     'mapel' => 'PAI & BP',                        'jurusan' => '-', 'foto' => 'asep_muhlis_sulaeman.jpg'],
              ['nama' => 'Asep Purnama',                      'mapel' => 'Laboran Teknik Otomotif',         'jurusan' => '-', 'foto' => 'asep_purnama.jpg'],
              ['nama' => 'Ayi Suryati, A.Ma.Pust.',           'mapel' => 'Administrasi Perpustakaan',       'jurusan' => '-', 'foto' => 'ayi_suryati.jpg'],
              ['nama' => 'Bani',                        'mapel' => '-', 'jurusan' => '-', 'foto' => 'bapak_bani.JPG'],
              ['nama' => 'Basar',                       'mapel' => '-', 'jurusan' => '-', 'foto' => 'bapak_basar.JPG'],
              ['nama' => 'Budi',                        'mapel' => '-', 'jurusan' => '-', 'foto' => 'bapak_budi.JPG'],
              ['nama' => 'Budiana Hermawan, S.TP.',           'mapel' => 'APHP',                            'jurusan' => '-', 'foto' => 'budiana_hermawan.jpg'],
              ['nama' => 'D Jamaludin',                       'mapel' => 'Kebersihan & Keindahan Sekolah', 'jurusan' => '-', 'foto' => 'd_jamaludin.jpg'],
              ['nama' => 'Dedi Sukardi, S.Pd.',               'mapel' => 'PJOK',                            'jurusan' => '-', 'foto' => 'dedi_sukardi.jpg'],
              ['nama' => 'Didi Mei Somatri, S.Kom.',          'mapel' => 'PPLG',                            'jurusan' => '-', 'foto' => 'didi_mei_somatri.jpg'],
              ['nama' => 'Habib Suhandar, S.Pd.',             'mapel' => 'Pendidikan Pancasila & Sejarah',  'jurusan' => '-', 'foto' => 'habib_suhandar.jpg'],
              ['nama' => 'Ende',                         'mapel' => '-', 'jurusan' => '-', 'foto' => 'bapak_ende.JPG'],
              ['nama' => 'Indra Murgianto, S.Pd.',            'mapel' => 'Pemasaran',                       'jurusan' => '-', 'foto' => 'indra_murgianto.jpg'],
              ['nama' => 'Indra Priatna, S.Pd.',              'mapel' => 'Pendidikan Pancasila & Informatika', 'jurusan' => '-', 'foto' => 'indra_priatna.jpg'],
              ['nama' => 'Isnan Wiranursyeha, S.Pd.',         'mapel' => 'Bahasa Indonesia',                'jurusan' => '-', 'foto' => 'isnan_wiranursyeha.jpg'],
              ['nama' => 'Jajang Ridwan, S.T.',               'mapel' => 'Teknik Otomotif',                 'jurusan' => '-', 'foto' => 'jajang_ridwan.jpg'],
              ['nama' => 'Jaya Nur Setiawandi, S.Pd.',        'mapel' => 'PJOK & Bahasa Sunda',             'jurusan' => '-', 'foto' => 'jaya_nur_setiawandi.jpg'],
              ['nama' => 'Kamalia, S.E.',                     'mapel' => 'Pemasaran',                       'jurusan' => '-', 'foto' => 'kamalia.jpg'],
              ['nama' => 'Mega Nurunnisa, S.Pd.',             'mapel' => 'Bahasa Indonesia & Seni Budaya',  'jurusan' => '-', 'foto' => 'mega_nurunnisa.jpg'],
              ['nama' => 'Muldiansyah',                   'mapel' => '-', 'jurusan' => '-', 'foto' => 'bapak_muldiansyah.JPG'],
              ['nama' => 'Najib',                         'mapel' => '-', 'jurusan' => '-', 'foto' => 'bapak_najib.JPG'],
              ['nama' => 'Nanang Suryana',                'mapel' => '-', 'jurusan' => '-', 'foto' => 'bapak_nanang_suryana.JPG'],
              ['nama' => 'Nama belum diisi (PKN)',        'mapel' => 'PKN', 'jurusan' => '-', 'foto' => 'bapak_pkn.jpeg'],
              ['nama' => 'Rahmat Setiawan',               'mapel' => '-', 'jurusan' => '-', 'foto' => 'bapak_rahmat.JPG'],
              ['nama' => 'Romi',                          'mapel' => '-', 'jurusan' => '-', 'foto' => 'bapak_romi.JPG'],
              ['nama' => ' Setiawan',                    'mapel' => '-', 'jurusan' => '-', 'foto' => 'bapak setiawan.JPG'],
              ['nama' => 'bapak tu',                      'mapel' => '-', 'jurusan' => '-', 'foto' => 'bapak tu.JPG'],
              ['nama' => 'wahyudin',                     'mapel' => '-', 'jurusan' => '-', 'foto' => 'bapak wahyudin.JPG'],
              ['nama' => 'wira',                          'mapel' => '-', 'jurusan' => '-', 'foto' => 'bapak wira.JPG'],
          ];

          $sumberGuru = $daftarGuruAdmin ?? $guru ?? [];
          $jumlahGuru = is_array($sumberGuru) ? count($sumberGuru) : $sumberGuru->count();

          $namaKepsek  = $kepalaSekolah->nama ?? 'A Rahmat Dimyati, S.Pd., M.Pd.';
          $fotoKepsek  = ($kepalaSekolah->foto ?? null) ? asset('storage/images/'.$kepalaSekolah->foto) : asset('images/beranda/a_rahmat_dimyati.jpeg');

        $guruPerHalaman = 6;
        $totalHalamanGuru = (int) ceil($jumlahGuru / $guruPerHalaman);
        @endphp

        <div class="pv-section" style="margin-top:8px;">

          <div class="pv-guru-featured">
            <div class="pv-guru-featured-card">
              <div class="pv-guru-featured-photo">
                <img src="{{ $fotoKepsek }}" alt="Foto {{ $namaKepsek }}" data-lightbox style="cursor:zoom-in;"
                     onerror="this.closest('.pv-guru-featured-photo').innerHTML='<div class=&quot;pv-placeholder-img&quot;></div>';">
              </div>
              <div class="pv-guru-featured-name">{{ $namaKepsek }}</div>
              <div class="pv-guru-featured-role">Kepala Sekolah</div>
            </div>
          </div>

          <div class="pv-guru-page-grid" id="guruPageGrid">
            @forelse($sumberGuru as $i => $g)
             @php
  $namaG    = is_array($g) ? $g['nama'] : $g->nama;
  $mapelG   = is_array($g) ? $g['mapel'] : $g->mapel;
  $jabatanG = is_array($g) ? ($g['jabatan'] ?? null) : ($g->jabatan ?? null);
  $roleG    = $mapelG ?: $jabatanG;
  $jurusanG = is_array($g)
      ? ($g['jurusan'] ?? null)
      : (optional($g->jurusan)->nama ?? null);
  $fotoG    = is_array($g) ? ($g['foto'] ?? null) : ($g->foto ?? null);
  // Data asli dari database (bukan array demo hardcode) -> foto ada di storage
  $isDataAsli = !is_array($g);
@endphp
              <div class="pv-guru-page-card" data-page="{{ intdiv($i, $guruPerHalaman) + 1 }}" @if($i >= $guruPerHalaman) style="display:none;" @endif>
                <div class="pv-guru-page-photo">
                  @if($fotoG)
                    <img src="{{ $isDataAsli ? asset('storage/images/guru-guru/'.rawurlencode($fotoG)) : asset('images/guru-guru/'.rawurlencode($fotoG)) }}" alt="Foto {{ $namaG }}"
                         data-lightbox style="cursor:zoom-in;"
                         onerror="this.closest('.pv-guru-page-photo').innerHTML='<div class=&quot;pv-placeholder-img&quot;></div>';">
                  @else
                    <div class="pv-placeholder-img"></div>
                  @endif
                </div>
                <div class="pv-guru-page-name">{{ $namaG }}</div>
                @if($roleG && $roleG !== '-')
                  <div class="pv-guru-page-role">{{ $roleG }}</div>
                @endif
                @if($jurusanG && $jurusanG !== '-')
                  <div class="pv-guru-page-sub">Guru ~ {{ $jurusanG }}</div>
                @endif
              </div>
            @empty
              <p class="pv-subtext">Belum ada data guru.</p>
            @endforelse
          </div>

          @if($totalHalamanGuru > 1)
            <div class="pv-guru-nav" id="guruNav" data-total="{{ $totalHalamanGuru }}">
              <button type="button" class="pv-guru-nav-btn" id="guruPrev" aria-label="Pegawai sebelumnya">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="m15 18-6-6 6-6"/></svg>
              </button>
              <button type="button" class="pv-guru-nav-btn" id="guruNext" aria-label="Pegawai selanjutnya">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="m9 18 6-6-6-6"/></svg>
              </button>
            </div>
          @endif

         <a href="#" class="pv-guru-viewall" id="guruViewAllBtn">Lihat Semua Pegawai</a>
        </div>
      </section>

     <!-- ============ PAGE: EKSTRAKURIKULER ============ -->
      <section class="page" id="page-ekstrakurikuler">
        <div class="pv-section">
          <h2 class="pv-title">Ekstrakurikuler</h2>
          <p class="pv-subtext">Pilih dan daftarkan dirimu di kegiatan ekstrakurikuler favoritmu.</p>

       <div class="pv-ekskul-grid">
  @forelse($daftarEkskul as $e)
    <a href="{{ !empty($e['route']) && \Illuminate\Support\Facades\Route::has($e['route']) ? route($e['route']) : url('/') }}"
       class="pv-ekskul-card">
      <div class="pv-ekskul-icon">
        @if($e['foto'] ?? false)
          <img src="{{ asset($e['foto']) }}" alt="{{ $e['nama'] }}"
               onerror="this.closest('.pv-ekskul-icon').innerHTML='<div class=&quot;pv-ekskul-icon-fallback&quot;>{{ \Illuminate\Support\Str::of($e['nama'])->substr(0,1)->upper() }}</div>';">
        @else
          <div class="pv-ekskul-icon-fallback">{{ \Illuminate\Support\Str::of($e['nama'])->substr(0,1)->upper() }}</div>
        @endif
      </div>
      <div class="pv-ekskul-name">{{ $e['nama'] }}</div>
    </a>
  @empty
    <p class="pv-subtext">Belum ada data ekstrakurikuler.</p>
  @endforelse
</div>
        </div>
      </section>
          <!-- ============ PAGE: KONTAK ============ -->
      <section class="page" id="page-kontak">
        @php
          $alamatK    = $kontak->alamat    ?? $profil->alamat  ?? null;
          $teleponK   = $kontak->telepon   ?? $profil->telepon ?? null;
          $emailK     = $kontak->email     ?? $profil->email   ?? null;
          $websiteK   = $kontak->website   ?? $profil->website ?? null;
          $whatsappK  = $kontak->whatsapp  ?? '6285641826589';
          $jamK       = $kontak->jam_operasional ?? null;
          $mapsK      = $kontak->maps_embed ?? null;
          $facebookK  = $kontak->facebook  ?? 'https://www.facebook.com/smkn1cijatiofficial-106581810689075';
          $instagramK = $kontak->instagram ?? 'https://www.instagram.com/smkn1cijatiofficial/';
          $youtubeK   = $kontak->youtube   ?? 'https://www.youtube.com/@smkn1cijatiofficial';
        @endphp

        <div class="page-head">
          <div class="eyebrow">Hubungi Kami</div>
          <h1>Kontak</h1>
          <p>Informasi kontak resmi {{ $profil->nama_sekolah ?? 'SMK Negeri 1 Cijati' }}.</p>
        </div>

        <div class="panel">
          <h3>Informasi Kontak</h3>
          <div class="kontak-grid">
            <div class="kontak-item">
              <div class="kontak-label">Alamat</div>
              <div class="kontak-value">{{ $alamatK ?: '-' }}</div>
            </div>
            <div class="kontak-item">
              <div class="kontak-label">Telepon</div>
              <div class="kontak-value">
                @if($teleponK)
                  <a href="tel:{{ $teleponK }}">{{ $teleponK }}</a>
                @else
                  -
                @endif
              </div>
            </div>
            <div class="kontak-item">
              <div class="kontak-label">WhatsApp</div>
              <div class="kontak-value">
                @if($whatsappK)
                  <a href="https://wa.me/{{ $whatsappK }}" target="_blank" rel="noopener noreferrer">wa.me/{{ $whatsappK }}</a>
                @else
                  -
                @endif
              </div>
            </div>
            <div class="kontak-item">
              <div class="kontak-label">Email</div>
              <div class="kontak-value">
                @if($emailK)
                  <a href="mailto:{{ $emailK }}">{{ $emailK }}</a>
                @else
                  -
                @endif
              </div>
            </div>
            <div class="kontak-item">
              <div class="kontak-label">Website</div>
              <div class="kontak-value">
                @if($websiteK)
                  <a href="https://{{ preg_replace('#^https?://#', '', $websiteK) }}" target="_blank" rel="noopener noreferrer">{{ $websiteK }}</a>
                @else
                  -
                @endif
              </div>
            </div>
            <div class="kontak-item">
              <div class="kontak-label">Jam Operasional</div>
              <div class="kontak-value">{{ $jamK ?: '-' }}</div>
            </div>
            <div class="kontak-item">
              <div class="kontak-label">Media Sosial</div>
              <div class="kontak-value kontak-sosmed">
                @if($facebookK)<a href="{{ $facebookK }}" target="_blank" rel="noopener noreferrer">Facebook</a>@endif
                @if($instagramK)<a href="{{ $instagramK }}" target="_blank" rel="noopener noreferrer">Instagram</a>@endif
                @if($youtubeK)<a href="{{ $youtubeK }}" target="_blank" rel="noopener noreferrer">YouTube</a>@endif
              </div>
            </div>
          </div>
        </div>

        @if($mapsK)
          <div class="panel" style="margin-top:20px;">
            <h3>Lokasi Sekolah</h3>
            <iframe src="{{ $mapsK }}" width="100%" height="380" style="border:0;border-radius:12px;"
                    allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        @endif
      </section>

  <!-- ============ FOOTER (gaya 4 kolom, mirip SMKN 2 Bandung) ============ -->
<footer class="pv-footer-dark">
  <div class="pv-footer-dark-inner">

    <div class="pv-footer-dark-col pv-footer-dark-brand">
      @if(isset($profil) && $profil->logo)
        <img src="{{ asset('storage/images/'.$profil->logo) }}" alt="Logo {{ $profil->nama_sekolah ?? 'Sekolah' }}">
      @else
        <img src="{{ asset('images/logo-smkn1cijati.png') }}" alt="Logo Sekolah">
      @endif
      <div class="pv-footer-dark-name">{{ $profil->nama_sekolah ?? 'SMK Negeri 1 Cijati' }}</div>
      <div class="pv-footer-dark-address">{{ $profil->alamat ?: 'Alamat belum diisi' }}</div>
    </div>

    <div class="pv-footer-dark-col">
      <div class="pv-footer-dark-title">Menu</div>
      <a href="#" class="pv-footer-dark-link menu-item" data-page="beranda">Beranda</a>
      <a href="#" class="pv-footer-dark-link menu-item" data-page="profil">Profil Sekolah</a>
      <a href="#" class="pv-footer-dark-link menu-item" data-page="jurusan">kompetensi Keahlian</a>
      <a href="#" class="pv-footer-dark-link menu-item" data-page="artikel">Artikel</a>
      <a href="#" class="pv-footer-dark-link menu-item" data-page="pasilitas">Fasilitas</a>
    </div>

    <div class="pv-footer-dark-col">
      <div class="pv-footer-dark-title">Lainnya</div>
      <a href="#" class="pv-footer-dark-link menu-item" data-page="guru">Guru &amp; Staff</a>
      <a href="#" class="pv-footer-dark-link menu-item" data-page="ekstrakurikuler">Ekstrakurikuler</a>
      <a href="#" class="pv-footer-dark-link menu-item" data-page="kontak">Kontak</a>
      <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($profil->alamat ?? 'SMK Negeri 1 Cijati, Jl. Raya Cijati, Kec. Cijati, Kab. Cianjur, Jawa Barat') }}"
         target="_blank" rel="noopener noreferrer" class="pv-footer-dark-link">Lokasi Sekolah</a>
    </div>

    <div class="pv-footer-dark-col">
      <div class="pv-footer-dark-title">Hubungi Kami</div>

      <div class="pv-footer-dark-contact">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 6-10 7L2 6"/></svg>
        @if(!empty($profil->email))
          <a href="mailto:{{ $profil->email }}">{{ $profil->email }}</a>
        @else
          <span>Email belum diisi</span>
        @endif
      </div>

      <div class="pv-footer-dark-contact">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.46 1.32 4.96L2.05 22l5.25-1.38a9.87 9.87 0 0 0 4.74 1.21h.01c5.46 0 9.91-4.45 9.91-9.91C21.96 6.45 17.5 2 12.04 2Z"/></svg>
        <a href="https://wa.me/6285641826589" target="_blank" rel="noopener noreferrer">wa.me/6285641826589</a>
      </div>

      <div class="pv-footer-dark-contact">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.68 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.32 1.85.55 2.81.68A2 2 0 0 1 22 16.92Z"/></svg>
        @if(!empty($profil->telepon))
          <a href="tel:{{ $profil->telepon }}">{{ $profil->telepon }}</a>
        @else
          <span>Telepon belum diisi</span>
        @endif
      </div>

      <div class="pv-footer-dark-title" style="margin-top:16px;">Ikuti Kami</div>
      <div class="pv-footer-dark-social">
        <a href="https://www.instagram.com/smkn1cijatiofficial/" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1"/></svg>
        </a>
        <a href="https://www.facebook.com/smkn1cijatiofficial-106581810689075" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M13.5 21v-8h2.7l.4-3.1h-3.1V8c0-.9.25-1.5 1.53-1.5H16.7V3.7C16.4 3.66 15.4 3.58 14.24 3.58c-2.4 0-4.04 1.47-4.04 4.16V9.9H7.5V13h2.7v8h3.3Z"/></svg>
        </a>
        <a href="https://www.youtube.com/@smkn1cijatiofficial" target="_blank" rel="noopener noreferrer" aria-label="YouTube">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M23 12s0-3.4-.4-5a3 3 0 0 0-2.1-2.1C18.9 4.5 12 4.5 12 4.5s-6.9 0-8.5.4A3 3 0 0 0 1.4 7C1 8.6 1 12 1 12s0 3.4.4 5a3 3 0 0 0 2.1 2.1c1.6.4 8.5.4 8.5.4s6.9 0 8.5-.4A3 3 0 0 0 22.6 17c.4-1.6.4-5 .4-5Zm-13.5 3.3V8.7L15.8 12l-6.3 3.3Z"/></svg>
        </a>
      </div>
    </div>

  </div>

  <div class="pv-footer-dark-copy">
    Copyright &copy; {{ date('Y') }} {{ $profil->nama_sekolah ?? 'SMK Negeri 1 Cijati' }}.
  </div>
</footer>

   
<!-- ============ FLOATING ACTION BUTTONS ============ -->
<div class="fab-stack">
  <a href="https://wa.me/6285641826589?text=Halo%20Admin%20SMKN%201%20Cijati"
     target="_blank" rel="noopener noreferrer"
     class="fab-btn whatsapp" aria-label="Chat WhatsApp">
    <svg width="26" height="26" viewBox="0 0 24 24" fill="currentColor">
      <path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.46 1.32 4.96L2.05 22l5.25-1.38a9.87 9.87 0 0 0 4.74 1.21h.01c5.46 0 9.91-4.45 9.91-9.91C21.96 6.45 17.5 2 12.04 2Zm0 18.06h-.01a8.2 8.2 0 0 1-4.19-1.15l-.3-.18-3.12.82.83-3.04-.2-.31a8.18 8.18 0 0 1-1.26-4.39c0-4.55 3.7-8.24 8.25-8.24 2.2 0 4.27.86 5.83 2.42a8.17 8.17 0 0 1 2.41 5.83c0 4.55-3.7 8.24-8.24 8.24Zm4.51-6.17c-.25-.12-1.46-.72-1.68-.8-.23-.08-.39-.12-.56.12-.16.25-.64.8-.79.96-.14.16-.29.18-.54.06-.25-.12-1.06-.39-2.02-1.24-.75-.67-1.25-1.5-1.4-1.75-.14-.25-.02-.38.11-.51.11-.11.25-.29.37-.43.12-.14.16-.25.25-.41.08-.16.04-.31-.02-.43-.06-.12-.56-1.34-.76-1.84-.2-.48-.41-.42-.56-.42h-.48c-.16 0-.43.06-.65.31-.22.25-.86.84-.86 2.05 0 1.21.88 2.38 1 2.54.12.16 1.73 2.64 4.19 3.7.59.25 1.04.4 1.4.52.59.19 1.12.16 1.54.1.47-.07 1.46-.6 1.66-1.18.21-.58.21-1.08.15-1.18-.06-.1-.23-.16-.48-.28Z"/>
    </svg>
  </a>

  <a href="#" class="fab-btn secondary" aria-label="Kembali ke atas"
     onclick="window.scrollTo({top:0,behavior:'smooth'}); return false;">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      <path d="M12 19V5"/><path d="m5 12 7-7 7 7"/>
    </svg>
  </a>
</div>

<!-- ============ LIGHTBOX FOTO (klik foto untuk melihat ukuran penuh) ============ -->
<div class="pv-lightbox-overlay" id="pvLightbox">
  <button type="button" class="pv-lightbox-close" onclick="closeLightbox()" aria-label="Tutup">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
  </button>
  <img id="pvLightboxImg" src="" alt="" onclick="event.stopPropagation()">
</div>

<!-- ============ MODAL GALERI VIDEO ============ -->
<div class="pv-video-modal-overlay" id="pvVideoModal">
  <div class="pv-video-modal-box">
    <div class="pv-video-modal-frame" id="pvVideoModalFrame"></div>
  </div>
  <button type="button" class="pv-lightbox-close" onclick="closeVideoModal()" aria-label="Tutup"
          style="position:fixed;top:24px;right:28px;">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4">
      <path d="M18 6 6 18"/><path d="m6 6 12 12"/>
    </svg>
  </button>
</div>

<script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>