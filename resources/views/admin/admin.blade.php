<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Panel Kelola Data — Admin SMK Negeri 1 Cijati</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
<div id="alert-box" class="alert" style="display:none;position:fixed;top:20px;right:20px;z-index:9999;padding:12px 18px;border-radius:8px;font-size:13.5px;"></div>

@php
    $activeTab = $activeTab ?? 'profil';

   $tabs = [
    'profil'    => 'Profil Sekolah',
    'beranda'   => 'Beranda',
    'sambutan'  => 'Sambutan Kepala Sekolah',
    'statistik' => 'Statistik Sekolah',
    'jurusan'   => 'Jurusan',
    'guru'      => 'Guru & Staff',
    'ekskul'    => 'Ekstrakurikuler',
    'galeri-video' => 'Galeri Video',
    'fasilitas' => 'Fasilitas',
    'seragam'   => 'Seragam',
    'artikel'   => 'Artikel',
    'agenda'    => 'Agenda',
    'prestasi'  => 'Prestasi',
];

   $tabIcons = [
    'profil'       => '🏫',
    'beranda'      => '🏠',
    'sambutan'     => '🧑‍💼',
    'statistik'    => '📊',
    'jurusan'      => '🎓',
    'guru'         => '👩‍🏫',
    'ekskul'       => '🤾',
    'galeri-video' => '🎬',
    'fasilitas'    => '🏢',
    'seragam'      => '👔',
    'artikel'      => '📰',
    'agenda'       => '🗓️',
    'prestasi'     => '🏆',
];
@endphp

<div class="layout">

  <aside class="admin-sidebar">
    <div class="sidebar-brand">
      <div class="sidebar-brand-mark">🏫</div>
      <div>
        <div class="name">{{ $profil->nama_sekolah ?? 'SMK Negeri 1 Cijati' }}</div>
        <div class="tagline">Panel Kelola Data</div>
      </div>
    </div>
    <div class="sidebar-menu-label">Menu</div>
    <nav class="sidebar-nav">
      @foreach($tabs as $key => $label)
        <a href="#" class="sidebar-nav-item admin-tab-link {{ $activeTab === $key ? 'active' : '' }}" data-target="{{ $key }}">
          <span class="sidebar-nav-icon" aria-hidden="true">{{ $tabIcons[$key] ?? '•' }}</span>
          {{ $label }}
        </a>
      @endforeach
    </nav>
    <form method="POST" action="{{ Route::has('logout') ? route('logout') : '#' }}" class="sidebar-logout-form">
      @csrf
      <button type="submit" class="sidebar-logout">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="M16 17l5-5-5-5"/><path d="M21 12H9"/></svg>
        Logout
      </button>
    </form>
  </aside>

  <div class="main">
    <div class="admin-topbar">
      <div class="admin-topbar-left">
        <button type="button" class="sidebar-toggle" id="sidebarToggle" aria-label="Buka menu">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 6h18M3 12h18M3 18h18"/></svg>
        </button>
        <div class="eyebrow" style="margin:0;">Panel Admin</div>
      </div>
      <div class="admin-topbar-right">
        <a href="{{ url('/') }}" class="btn">🔗 Lihat Situs</a>
      </div>
    </div>

    <div class="content">

      <div class="page-title-row">
        <h1 id="adminPageTitle">{{ $tabIcons[$activeTab] ?? '' }} {{ $tabs[$activeTab] }}</h1>
        <span class="admin-badge">⚙️ Administrator</span>
      </div>

      @if(session('success'))
        <div class="crud-alert-success">{{ session('success') }}</div>
      @endif
      @if($errors->any())
        <div class="crud-alert-error">
          <div>
            Terjadi kesalahan pada input:
            <ul>
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        </div>
      @endif

      {{-- =====================================================
           TAB: PROFIL SEKOLAH
      ====================================================== --}}
      <section class="admin-section {{ $activeTab === 'profil' ? 'active' : '' }}" data-section="profil">
        <form method="POST" action="{{ route('admin.profil.update') }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="panel">
            <h3 class="panel-title">📋 Data Umum</h3>
            <div class="grid-2">
              <div class="field full">
                <label>Nama Sekolah</label>
                <input type="text" name="nama_sekolah" value="{{ old('nama_sekolah', $profil->nama_sekolah ?? '') }}" required>
              </div>
              <div class="field full">
                <label>Moto / Tagline</label>
                <input type="text" name="moto" value="{{ old('moto', $profil->moto ?? '') }}">
              </div>
              <div class="field">
                <label>NPSN</label>
                <input type="text" name="npsn" value="{{ old('npsn', $profil->npsn ?? '') }}">
              </div>
              <div class="field">
                <label>Telepon</label>
                <input type="tel" name="telepon" value="{{ old('telepon', $profil->telepon ?? '') }}">
              </div>
              <div class="field full">
                <label>Alamat</label>
                <textarea name="alamat" rows="2">{{ old('alamat', $profil->alamat ?? '') }}</textarea>
              </div>
              <div class="field">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $profil->email ?? '') }}">
              </div>
              <div class="field">
                <label>Website</label>
                <input type="url" name="website" value="{{ old('website', $profil->website ?? '') }}" placeholder="smkn1cijati.sch.id">
              </div>
            </div>
          </div>

          <div class="panel">
            <h3 class="panel-title">📖 Sejarah, Visi &amp; Misi</h3>
            <div class="field full">
              <label>Sejarah</label>
              <textarea name="sejarah" rows="5">{{ old('sejarah', $profil->sejarah ?? '') }}</textarea>
            </div>
            <div class="field full">
              <label>Visi</label>
              <textarea name="visi" rows="3">{{ old('visi', $profil->visi ?? '') }}</textarea>
            </div>
            <div class="field full">
              <label>Misi</label>
              <textarea name="misi" rows="6">{{ old('misi', is_array($profil->misi ?? null) ? implode("\n", $profil->misi) : ($profil->misi ?? '')) }}</textarea>
              <small>Tulis satu poin misi per baris.</small>
            </div>
            <div class="field full">
              <label>Deskripsi (About Us)</label>
              <textarea name="deskripsi" rows="4">{{ old('deskripsi', $profil->deskripsi ?? '') }}</textarea>
            </div>
          </div>

          <div class="panel">
            <h3 class="panel-title">🖼️ Logo &amp; Foto</h3>
            <div class="field full">
              <label>Logo Sekolah</label>
              <div class="file-row">
                @if(!empty($profil->logo))
                  <img src="{{ asset('storage/images/'.$profil->logo) }}" alt="Logo saat ini">
                @endif
                <input type="file" name="logo" accept="image/*">
              </div>
              <small>Kosongkan jika tidak ingin mengganti logo.</small>
            </div>
            <div class="field full">
              <label>Foto Hero (Beranda)</label>
              <div class="file-row">
                @if(!empty($profil->foto_hero))
                  <img class="file-preview-wide" src="{{ asset('storage/images/'.$profil->foto_hero) }}" alt="Foto hero saat ini">
                @endif
                <input type="file" name="foto_hero" accept="image/*">
              </div>
              <small>Kosongkan jika tidak ingin mengganti foto hero.</small>
            </div>
            <div class="field full">
              <label>Foto Sambutan / Gerbang</label>
              <div class="file-row">
                @if(!empty($profil->foto_sambutan))
                  <img src="{{ asset('storage/images/'.$profil->foto_sambutan) }}" alt="Foto sambutan saat ini">
                @endif
                <input type="file" name="foto_sambutan" accept="image/*">
              </div>
              <small>Kosongkan jika tidak ingin mengganti foto.</small>
            </div>
          </div>

          <div class="actions">
            <button type="submit" class="btn primary">💾 Simpan Perubahan</button>
          </div>
        </form>
      </section>

 {{-- =====================================================
     TAB: BERANDA (Tentang Kami)
====================================================== --}}
<section class="admin-section {{ $activeTab === 'beranda' ? 'active' : '' }}" data-section="beranda">
  <form method="POST" action="{{ route('admin.beranda.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="panel">
      <h3 class="panel-title">🏠 Tentang Kami</h3>
      <div class="field full">
        <label>Judul</label>
        <input type="text" name="judul" value="{{ old('judul', $beranda->judul ?? '') }}">
      </div>
      <div class="field full">
        <label>Deskripsi</label>
        <textarea name="deskripsi" rows="5">{{ old('deskripsi', $beranda->deskripsi ?? '') }}</textarea>
      </div>
      <div class="field full">
        <label>Foto</label>
        <div class="file-row">
          @if(!empty($beranda->foto))
            <img src="{{ asset('storage/images/'.$beranda->foto) }}" alt="Foto beranda saat ini">
          @endif
          <input type="file" name="foto" accept="image/*">
        </div>
        <small>Kosongkan jika tidak ingin mengganti foto.</small>
      </div>
    </div>

    <div class="actions">
      <button type="submit" class="btn primary">💾 Simpan Perubahan</button>
    </div>
  </form>
</section>

{{-- =====================================================
     TAB: SAMBUTAN KEPALA SEKOLAH
====================================================== --}}
<section class="admin-section {{ $activeTab === 'sambutan' ? 'active' : '' }}" data-section="sambutan">
  <form method="POST" action="{{ route('admin.kepsek.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="panel">
      <h3 class="panel-title">🧑‍💼 Sambutan Kepala Sekolah</h3>
      <div class="grid-2">
        <div class="field">
          <label>Nama Kepala Sekolah</label>
          <input type="text" name="kepsek_nama" value="{{ old('kepsek_nama', $kepalaSekolah->nama ?? '') }}" placeholder="mis. A Rahmat Dimyati, S.Pd., M.Pd." required>
        </div>
        <div class="field">
          <label>Jabatan</label>
          <input type="text" name="kepsek_jabatan" value="{{ old('kepsek_jabatan', $kepalaSekolah->jabatan ?? 'Kepala Sekolah') }}" required>
        </div>
      </div>
      <div class="field full">
        <label>Foto Kepala Sekolah</label>
        <div class="file-row">
          @if(!empty($kepalaSekolah->foto))
            <img src="{{ asset('storage/images/'.$kepalaSekolah->foto) }}" alt="Foto Kepala Sekolah saat ini">
          @endif
          <input type="file" name="kepsek_foto" accept="image/*">
        </div>
        <small>Kosongkan jika tidak ingin mengganti foto.</small>
      </div>
      <div class="field full">
        <label>Isi Sambutan</label>
        <textarea name="sambutan" rows="10" required>{{ old('sambutan', $kepalaSekolah->sambutan ?? '') }}</textarea>
        <small>Pisahkan tiap paragraf dengan baris kosong (Enter dua kali). Wajib diisi.</small>
      </div>
    </div>

    <div class="actions">
      <button type="submit" class="btn primary">💾 Simpan Perubahan</button>
    </div>
  </form>
</section>

{{-- =====================================================
     TAB: STATISTIK SEKOLAH
====================================================== --}}
<section class="admin-section {{ $activeTab === 'statistik' ? 'active' : '' }}" data-section="statistik">
  <form method="POST" action="{{ route('admin.statistik.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="panel">
      <h3 class="panel-title">📊 Statistik Sekolah</h3>
      <div class="grid-2">
        <div class="field">
          <label>Jumlah Siswa</label>
          <input type="number" name="jumlah_siswa" value="{{ old('jumlah_siswa', $statistik->jumlah_siswa ?? 0) }}" min="0">
        </div>
        <div class="field">
          <label>Jumlah Guru</label>
          <input type="number" name="jumlah_guru" value="{{ old('jumlah_guru', $statistik->jumlah_guru ?? 0) }}" min="0">
        </div>
      </div>
      <small>Angka ini yang ditampilkan di kartu "Statistik Sekolah" pada halaman Beranda.</small>
    </div>

    <div class="actions">
      <button type="submit" class="btn primary">💾 Simpan Perubahan</button>
    </div>
  </form>
</section>

      {{-- =====================================================
           TAB: JURUSAN
      ====================================================== --}}
      <section class="admin-section {{ $activeTab === 'jurusan' ? 'active' : '' }}" data-section="jurusan">
        <div class="panel">
          <div class="panel-head-row">
            <h3><span class="panel-head-icon">🎓</span> Daftar Jurusan <span class="count">{{ $jurusan->count() }} data</span></h3>
            <button type="button" class="btn primary btn-add" data-entity="jurusan">➕ Tambah Jurusan</button>
          </div>
          <table>
            <thead>
              <tr>
                <th>#</th><th>Kode</th><th>Logo</th><th>Nama Jurusan</th><th>Kepala Jurusan</th><th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($jurusan as $item)
                <tr>
                  <td class="no-cell">{{ $loop->iteration }}</td>
                  <td>{{ $item->kode }}</td>
                  <td>
                    @if($item->logo_jurusan)
                      <img src="{{ asset('storage/images/jurusan/'.$item->logo_jurusan) }}" class="thumb-logo">
                    @else
                      <span class="cell-empty">-</span>
                    @endif
                  </td>
                  <td>{{ $item->nama_jurusan }}</td>
                  <td>{{ $item->kepala_jurusan }}</td>
                  <td>
                    <button type="button" class="btn btn-edit" style="padding:5px 10px;font-size:12px;"
                      data-entity="jurusan"
                      data-id="{{ $item->id }}"
                      data-kode="{{ $item->kode }}"
                      data-nama_jurusan="{{ $item->nama_jurusan }}"
                      data-kepala_jurusan="{{ $item->kepala_jurusan }}"
                      data-foto_kepala_jurusan="{{ $item->foto_kepala_jurusan }}"
                      data-logo_jurusan="{{ $item->logo_jurusan }}"
                      data-foto="{{ $item->foto }}">✏️ Edit</button>
                    <form action="{{ route('admin.jurusan.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                      @csrf @method('DELETE')
                      <button type="submit" class="btn btn-hapus" style="padding:5px 10px;font-size:12px;">🗑️ Hapus</button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr><td colspan="6" class="cell-empty-row">Belum ada data jurusan.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <dialog class="crud-dialog" data-entity="jurusan" data-mode="add">
          <form method="POST" action="{{ route('admin.jurusan.store') }}" enctype="multipart/form-data">
            @csrf
            <h3>🎓 Tambah Jurusan</h3>
            <div class="field"><label>Kode</label><input type="text" name="kode" data-field="kode" placeholder="mis. TKR"></div>
            <div class="field"><label>Nama Jurusan</label><input type="text" name="nama_jurusan" data-field="nama_jurusan" required></div>
            <div class="field"><label>Kepala Jurusan</label><input type="text" name="kepala_jurusan" data-field="kepala_jurusan"></div>
            <div class="field"><label>Foto Kepala Jurusan</label><input type="file" name="foto_kepala_jurusan" accept="image/*"></div>
            <div class="field"><label>Logo Jurusan</label><input type="file" name="logo_jurusan" accept="image/*"></div>
            <div class="field"><label>Foto</label><input type="file" name="foto" accept="image/*"></div>
            <div class="dialog-actions">
              <button type="button" class="btn" data-close>Batal</button>
              <button type="submit" class="btn primary">💾 Simpan</button>
            </div>
          </form>
        </dialog>

        <dialog class="crud-dialog" data-entity="jurusan" data-mode="edit" data-image-base="{{ asset('storage/images/jurusan') }}/">
          <form method="POST" action="" enctype="multipart/form-data" class="form-edit" data-action-template="{{ route('admin.jurusan.update', ':id') }}">
            @csrf @method('PUT')
            <h3>✏️ Edit Jurusan</h3>
            <div class="field"><label>Kode</label><input type="text" name="kode" data-field="kode"></div>
            <div class="field"><label>Nama Jurusan</label><input type="text" name="nama_jurusan" data-field="nama_jurusan" required></div>
            <div class="field"><label>Kepala Jurusan</label><input type="text" name="kepala_jurusan" data-field="kepala_jurusan"></div>
            <div class="field">
              <label>Foto Kepala Jurusan</label>
              <div class="preview-wrap">
                <img data-preview="foto_kepala_jurusan" src="" alt="" style="display:none;border-radius:50%;">
                <span data-preview-empty="foto_kepala_jurusan" class="no-img">Belum ada foto</span>
              </div>
              <input type="file" name="foto_kepala_jurusan" accept="image/*" style="margin-top:8px;">
            </div>
            <div class="field">
              <label>Logo Jurusan</label>
              <div class="preview-wrap">
                <img data-preview="logo_jurusan" src="" alt="" style="display:none;">
                <span data-preview-empty="logo_jurusan" class="no-img">Belum ada logo</span>
              </div>
              <input type="file" name="logo_jurusan" accept="image/*" style="margin-top:8px;">
            </div>
            <div class="field">
              <label>Foto</label>
              <div class="preview-wrap">
                <img data-preview="foto" src="" alt="" style="display:none;">
                <span data-preview-empty="foto" class="no-img">Belum ada foto</span>
              </div>
              <input type="file" name="foto" accept="image/*" style="margin-top:8px;">
            </div>
            <div class="dialog-actions">
              <button type="button" class="btn" data-close>Batal</button>
              <button type="submit" class="btn primary">💾 Simpan Perubahan</button>
            </div>
          </form>
        </dialog>
      </section>

      {{-- =====================================================
           TAB: GURU & STAFF
      ====================================================== --}}
      <section class="admin-section {{ $activeTab === 'guru' ? 'active' : '' }}" data-section="guru">
        <div class="panel">
          <div class="panel-head-row">
            <h3><span class="panel-head-icon">👩‍🏫</span> Daftar Guru &amp; Staff <span class="count">{{ $guru->count() }} data</span></h3>
            <button type="button" class="btn primary btn-add" data-entity="guru">➕ Tambah Guru</button>
          </div>
          <table>
            <thead>
              <tr><th>#</th><th>Foto</th><th>Nama</th><th>NIP</th><th>Mapel / Jabatan</th><th>Jurusan</th><th>Staf?</th><th>Aksi</th></tr>
            </thead>
            <tbody>
              @forelse($guru as $item)
                <tr>
                  <td class="no-cell">{{ $loop->iteration }}</td>
                  <td>
                    @if($item->foto)
                      <img src="{{ asset('storage/images/guru-guru/'.$item->foto) }}" class="thumb-guru">
                    @else
                      <span class="cell-empty">-</span>
                    @endif
                  </td>
                  <td>{{ $item->nama }}</td>
                  <td>{{ $item->nip }}</td>
                  <td>{{ $item->staf ? $item->jabatan : $item->mapel }}</td>
                  <td>{{ $item->jurusan->nama_jurusan ?? '-' }}</td>
                  <td><span class="badge-staf {{ $item->staf ? 'ya' : 'tidak' }}">{{ $item->staf ? 'Ya' : 'Tidak' }}</span></td>
                  <td>
                    <button type="button" class="btn btn-edit" style="padding:5px 10px;font-size:12px;"
                      data-entity="guru"
                      data-id="{{ $item->id }}"
                      data-nama="{{ $item->nama }}"
                      data-nip="{{ $item->nip }}"
                      data-mapel="{{ $item->mapel }}"
                      data-jabatan="{{ $item->jabatan }}"
                      data-jurusan_id="{{ $item->jurusan_id }}"
                      data-staf="{{ $item->staf ? 1 : 0 }}"
                      data-foto="{{ $item->foto }}">✏️ Edit</button>
                    <form action="{{ route('admin.guru.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                      @csrf @method('DELETE')
                      <button type="submit" class="btn btn-hapus" style="padding:5px 10px;font-size:12px;">🗑️ Hapus</button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr><td colspan="8" class="cell-empty-row">Belum ada data guru & staff.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <dialog class="crud-dialog" data-entity="guru" data-mode="add">
          <form method="POST" action="{{ route('admin.guru.store') }}" enctype="multipart/form-data">
            @csrf
            <h3>👩‍🏫 Tambah Guru / Staff</h3>
            <div class="field"><label>Nama</label><input type="text" name="nama" data-field="nama" required></div>
            <div class="field"><label>NIP</label><input type="text" name="nip" data-field="nip" placeholder="-"></div>
            <div class="field checkbox-field">
              <input type="checkbox" name="staf" id="stafAdd" value="1" data-field="staf">
              <label for="stafAdd" style="margin:0;">Termasuk Staf (bukan guru mapel)</label>
            </div>
            <div class="field"><label>Mata Pelajaran</label><input type="text" name="mapel" data-field="mapel"></div>
            <div class="field"><label>Jabatan</label><input type="text" name="jabatan" data-field="jabatan"></div>
            <div class="field">
              <label>Jurusan</label>
              <select name="jurusan_id" data-field="jurusan_id">
                <option value="">- Tidak terikat jurusan -</option>
                @foreach($jurusanList as $j)
                  <option value="{{ $j->id }}">{{ $j->nama_jurusan }}</option>
                @endforeach
              </select>
            </div>
            <div class="field"><label>Foto</label><input type="file" name="foto" accept="image/*"></div>
            <div class="dialog-actions">
              <button type="button" class="btn" data-close>Batal</button>
              <button type="submit" class="btn primary">💾 Simpan</button>
            </div>
          </form>
        </dialog>

        <dialog class="crud-dialog" data-entity="guru" data-mode="edit" data-image-base="{{ asset('storage/images/guru-guru') }}/">
          <form method="POST" action="" enctype="multipart/form-data" class="form-edit" data-action-template="{{ route('admin.guru.update', ':id') }}">
            @csrf @method('PUT')
            <h3>✏️ Edit Guru / Staff</h3>
            <div class="field"><label>Nama</label><input type="text" name="nama" data-field="nama" required></div>
            <div class="field"><label>NIP</label><input type="text" name="nip" data-field="nip" placeholder="-"></div>
            <div class="field checkbox-field">
              <input type="checkbox" name="staf" id="stafEdit" value="1" data-field="staf">
              <label for="stafEdit" style="margin:0;">Termasuk Staf (bukan guru mapel)</label>
            </div>
            <div class="field"><label>Mata Pelajaran</label><input type="text" name="mapel" data-field="mapel"></div>
            <div class="field"><label>Jabatan</label><input type="text" name="jabatan" data-field="jabatan"></div>
            <div class="field">
              <label>Jurusan</label>
              <select name="jurusan_id" data-field="jurusan_id">
                <option value="">- Tidak terikat jurusan -</option>
                @foreach($jurusanList as $j)
                  <option value="{{ $j->id }}">{{ $j->nama_jurusan }}</option>
                @endforeach
              </select>
            </div>
            <div class="field">
              <label>Foto</label>
              <div class="preview-wrap">
                <img data-preview="foto" src="" alt="" style="display:none;border-radius:50%;">
                <span data-preview-empty="foto" class="no-img">Belum ada foto</span>
              </div>
              <input type="file" name="foto" accept="image/*" style="margin-top:8px;">
            </div>
            <div class="dialog-actions">
              <button type="button" class="btn" data-close>Batal</button>
              <button type="submit" class="btn primary">💾 Simpan Perubahan</button>
            </div>
          </form>
        </dialog>
      </section>

      {{-- =====================================================
           TAB: EKSTRAKURIKULER
      ====================================================== --}}
      <section class="admin-section {{ $activeTab === 'ekskul' ? 'active' : '' }}" data-section="ekskul">
        <div class="panel">
          <div class="panel-head-row">
            <h3><span class="panel-head-icon">🤾</span> Daftar Ekskul <span class="count">{{ $ekskul->count() }} data</span></h3>
            <button type="button" class="btn primary btn-add" data-entity="ekskul">➕ Tambah Ekskul</button>
          </div>
          <table>
            <thead><tr><th>#</th><th>Nama Ekskul</th><th>Pembina</th><th>Logo</th><th>Jadwal</th><th>Lokasi</th><th>Deskripsi</th><th>Aksi</th></tr></thead>
            <tbody>
              @forelse($ekskul as $item)
                <tr>
                  <td class="no-cell">{{ $loop->iteration }}</td>
                  <td>{{ $item->nama }}</td>
                  <td>{{ $item->pembina->nama ?? '-' }}</td>
                  <td>
                    @if($item->logo)
                      <img src="{{ asset('storage/images/'.$item->logo) }}" class="thumb-logo">
                    @else
                      <span class="cell-empty">-</span>
                    @endif
                  </td>
                  <td>{{ $item->jadwal }}</td>
                  <td>{{ $item->lokasi }}</td>
                  <td class="deskripsi-cell">{{ $item->deskripsi }}</td>
                  <td>
                    <button type="button" class="btn btn-edit" style="padding:5px 10px;font-size:12px;"
                      data-entity="ekskul"
                      data-id="{{ $item->id }}"
                      data-nama="{{ $item->nama }}"
                      data-id_pembina="{{ $item->id_pembina }}"
                      data-jadwal="{{ $item->jadwal }}"
                      data-lokasi="{{ $item->lokasi }}"
                      data-deskripsi="{{ $item->deskripsi }}"
                      data-logo="{{ $item->logo }}"
                      data-foto="{{ $item->foto }}">✏️ Edit</button>
                    <form action="{{ route('admin.ekskul.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                      @csrf @method('DELETE')
                      <button type="submit" class="btn btn-hapus" style="padding:5px 10px;font-size:12px;">🗑️ Hapus</button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr><td colspan="8" class="cell-empty-row">Belum ada data ekstrakurikuler.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <dialog class="crud-dialog" data-entity="ekskul" data-mode="add">
          <form method="POST" action="{{ route('admin.ekskul.store') }}" enctype="multipart/form-data">
            @csrf
            <h3>🤾 Tambah Ekskul</h3>
            <div class="field"><label>Nama Ekskul</label><input type="text" name="nama" data-field="nama" required></div>
            <div class="field">
              <label>Pembina</label>
              <select name="id_pembina" data-field="id_pembina">
                <option value="">- Belum ada pembina -</option>
                @foreach($guru as $g)
                  <option value="{{ $g->id }}">{{ $g->nama }}</option>
                @endforeach
              </select>
            </div>
            <div class="field"><label>Jadwal</label><input type="text" name="jadwal" data-field="jadwal" placeholder="mis. Rabu, 15.00 – 17.00"></div>
            <div class="field"><label>Lokasi</label><input type="text" name="lokasi" data-field="lokasi"></div>
            <div class="field"><label>Deskripsi</label><textarea name="deskripsi" data-field="deskripsi" rows="2"></textarea></div>
            <div class="field"><label>Logo</label><input type="file" name="logo" accept="image/*"></div>
            <div class="field"><label>Foto Kegiatan</label><input type="file" name="foto" accept="image/*"></div>
            <div class="dialog-actions">
              <button type="button" class="btn" data-close>Batal</button>
              <button type="submit" class="btn primary">💾 Simpan</button>
            </div>
          </form>
        </dialog>

        <dialog class="crud-dialog" data-entity="ekskul" data-mode="edit" data-image-base="{{ asset('storage/images') }}/">
          <form method="POST" action="" enctype="multipart/form-data" class="form-edit" data-action-template="{{ route('admin.ekskul.update', ':id') }}">
            @csrf @method('PUT')
            <h3>✏️ Edit Ekskul</h3>
            <div class="field"><label>Nama Ekskul</label><input type="text" name="nama" data-field="nama" required></div>
            <div class="field">
              <label>Pembina</label>
              <select name="id_pembina" data-field="id_pembina">
                <option value="">- Belum ada pembina -</option>
                @foreach($guru as $g)
                  <option value="{{ $g->id }}">{{ $g->nama }}</option>
                @endforeach
              </select>
            </div>
            <div class="field"><label>Jadwal</label><input type="text" name="jadwal" data-field="jadwal"></div>
            <div class="field"><label>Lokasi</label><input type="text" name="lokasi" data-field="lokasi"></div>
            <div class="field"><label>Deskripsi</label><textarea name="deskripsi" data-field="deskripsi" rows="2"></textarea></div>
            <div class="field">
              <label>Logo</label>
              <div class="preview-wrap">
                <img data-preview="logo" src="" alt="" style="display:none;">
                <span data-preview-empty="logo" class="no-img">Belum ada logo</span>
              </div>
              <input type="file" name="logo" accept="image/*" style="margin-top:8px;">
            </div>
            <div class="field">
              <label>Foto Kegiatan</label>
              <div class="preview-wrap">
                <img data-preview="foto" src="" alt="" style="display:none;">
                <span data-preview-empty="foto" class="no-img">Belum ada foto kegiatan</span>
              </div>
              <input type="file" name="foto" accept="image/*" style="margin-top:8px;">
            </div>
            <div class="dialog-actions">
              <button type="button" class="btn" data-close>Batal</button>
              <button type="submit" class="btn primary">💾 Simpan Perubahan</button>
            </div>
          </form>
        </dialog>
      </section>

      {{-- =====================================================
           TAB: GALERI VIDEO
      ====================================================== --}}
      <section class="admin-section {{ $activeTab === 'galeri-video' ? 'active' : '' }}" data-section="galeri-video">
        <div class="panel">
          <div class="panel-head-row">
            <h3><span class="panel-head-icon">🎬</span> Daftar Video</h3>
            <button type="button" class="btn primary btn-add" data-entity="galeri-video">➕ Tambah Video</button>
          </div>
          <table>
            <thead><tr><th>#</th><th>Thumbnail</th><th>Judul</th><th>YouTube ID</th><th>Aksi</th></tr></thead>
            <tbody>
              @forelse($galeriVideo as $item)
                <tr>
                  <td class="no-cell">{{ $loop->iteration }}</td>
                  <td>
                    @if($item->thumbnail)
                      <img src="{{ asset('storage/images/video/'.$item->thumbnail) }}" class="thumb-foto">
                    @else
                      <span class="cell-empty">-</span>
                    @endif
                  </td>
                  <td>{{ $item->judul }}</td>
                  <td>{{ $item->youtube_id }}</td>
                  <td>
                    <button type="button" class="btn btn-edit" style="padding:5px 10px;font-size:12px;"
                      data-entity="galeri-video"
                      data-id="{{ $item->id }}"
                      data-judul="{{ $item->judul }}"
                      data-youtube_id="{{ $item->youtube_id }}"
                      data-url="{{ $item->url }}"
                      data-thumbnail="{{ $item->thumbnail }}">✏️ Edit</button>
                    <form action="{{ route('admin.galeri-video.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                      @csrf @method('DELETE')
                      <button type="submit" class="btn btn-hapus" style="padding:5px 10px;font-size:12px;">🗑️ Hapus</button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr><td colspan="5" class="cell-empty-row">Belum ada video.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <dialog class="crud-dialog" data-entity="galeri-video" data-mode="add">
          <form method="POST" action="{{ route('admin.galeri-video.store') }}" enctype="multipart/form-data">
            @csrf
            <h3>🎬 Tambah Video</h3>
            <div class="field"><label>Judul</label><input type="text" name="judul" data-field="judul" required></div>
            <div class="field"><label>YouTube ID</label><input type="text" name="youtube_id" data-field="youtube_id" placeholder="mis. tnDxcQfZO4c"></div>
            <div class="field"><label>URL Video (kalau bukan YouTube)</label><input type="text" name="url" data-field="url"></div>
            <div class="field"><label>Thumbnail</label><input type="file" name="thumbnail" accept="image/*"></div>
            <div class="dialog-actions">
              <button type="button" class="btn" data-close>Batal</button>
              <button type="submit" class="btn primary">💾 Simpan</button>
            </div>
          </form>
        </dialog>

        <dialog class="crud-dialog" data-entity="galeri-video" data-mode="edit" data-image-base="{{ asset('storage/images/video') }}/">
          <form method="POST" action="" enctype="multipart/form-data" class="form-edit" data-action-template="{{ route('admin.galeri-video.update', ':id') }}">
            @csrf @method('PUT')
            <h3>✏️ Edit Video</h3>
            <div class="field"><label>Judul</label><input type="text" name="judul" data-field="judul" required></div>
            <div class="field"><label>YouTube ID</label><input type="text" name="youtube_id" data-field="youtube_id"></div>
            <div class="field"><label>URL Video (kalau bukan YouTube)</label><input type="text" name="url" data-field="url"></div>
            <div class="field">
              <label>Thumbnail</label>
              <div class="preview-wrap">
                <img data-preview="thumbnail" src="" alt="" style="display:none;">
                <span data-preview-empty="thumbnail" class="no-img">Belum ada thumbnail</span>
              </div>
              <input type="file" name="thumbnail" accept="image/*" style="margin-top:8px;">
            </div>
            <div class="dialog-actions">
              <button type="button" class="btn" data-close>Batal</button>
              <button type="submit" class="btn primary">💾 Simpan Perubahan</button>
            </div>
          </form>
        </dialog>
      </section>

      {{-- =====================================================
           TAB: FASILITAS
      ====================================================== --}}
      <section class="admin-section {{ $activeTab === 'fasilitas' ? 'active' : '' }}" data-section="fasilitas">
        <div class="panel">
          <div class="panel-head-row">
            <h3><span class="panel-head-icon">🏢</span> Daftar Fasilitas</h3>
            <button type="button" class="btn primary btn-add" data-entity="fasilitas">➕ Tambah Fasilitas</button>
          </div>
          <table>
            <thead><tr><th>#</th><th>Gambar</th><th>Nama</th><th>Deskripsi</th><th>Aksi</th></tr></thead>
            <tbody>
              @forelse($fasilitas as $item)
                <tr>
                  <td class="no-cell">{{ $loop->iteration }}</td>
                  <td>
                    @if($item->gambar)
                      <img src="{{ asset('storage/images/pasilitas/'.$item->gambar) }}" class="thumb-foto">
                    @else
                      <span class="cell-empty">-</span>
                    @endif
                  </td>
                  <td>{{ $item->nama_fasilitas }}</td>
                  <td class="deskripsi-cell">{{ $item->deskripsi }}</td>
                  <td>
                    <button type="button" class="btn btn-edit" style="padding:5px 10px;font-size:12px;"
                      data-entity="fasilitas"
                      data-id="{{ $item->id }}"
                      data-nama_fasilitas="{{ $item->nama_fasilitas }}"
                      data-deskripsi="{{ $item->deskripsi }}"
                      data-gambar="{{ $item->gambar }}">✏️ Edit</button>
                    <form action="{{ route('admin.fasilitas.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                      @csrf @method('DELETE')
                      <button type="submit" class="btn btn-hapus" style="padding:5px 10px;font-size:12px;">🗑️ Hapus</button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr><td colspan="5" class="cell-empty-row">Belum ada data fasilitas.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <dialog class="crud-dialog" data-entity="fasilitas" data-mode="add">
          <form method="POST" action="{{ route('admin.fasilitas.store') }}" enctype="multipart/form-data">
            @csrf
            <h3>🏢 Tambah Fasilitas</h3>
            <div class="field"><label>Nama Fasilitas</label><input type="text" name="nama_fasilitas" data-field="nama_fasilitas" required></div>
            <div class="field"><label>Deskripsi</label><textarea name="deskripsi" data-field="deskripsi" rows="2"></textarea></div>
            <div class="field"><label>Gambar</label><input type="file" name="gambar" accept="image/*"></div>
            <div class="dialog-actions">
              <button type="button" class="btn" data-close>Batal</button>
              <button type="submit" class="btn primary">💾 Simpan</button>
            </div>
          </form>
        </dialog>

        <dialog class="crud-dialog" data-entity="fasilitas" data-mode="edit" data-image-base="{{ asset('storage/images/pasilitas') }}/">
          <form method="POST" action="" enctype="multipart/form-data" class="form-edit" data-action-template="{{ route('admin.fasilitas.update', ':id') }}">
            @csrf @method('PUT')
            <h3>✏️ Edit Fasilitas</h3>
            <div class="field"><label>Nama Fasilitas</label><input type="text" name="nama_fasilitas" data-field="nama_fasilitas" required></div>
            <div class="field"><label>Deskripsi</label><textarea name="deskripsi" data-field="deskripsi" rows="2"></textarea></div>
            <div class="field">
              <label>Gambar</label>
              <div class="preview-wrap">
                <img data-preview="gambar" src="" alt="" style="display:none;">
                <span data-preview-empty="gambar" class="no-img">Belum ada gambar</span>
              </div>
              <input type="file" name="gambar" accept="image/*" style="margin-top:8px;">
            </div>
            <div class="dialog-actions">
              <button type="button" class="btn" data-close>Batal</button>
              <button type="submit" class="btn primary">💾 Simpan Perubahan</button>
            </div>
          </form>
        </dialog>
      </section>

      {{-- =====================================================
           TAB: SERAGAM
      ====================================================== --}}
      <section class="admin-section {{ $activeTab === 'seragam' ? 'active' : '' }}" data-section="seragam">
        <div class="panel">
          <div class="panel-head-row">
            <h3><span class="panel-head-icon">👔</span> Daftar Seragam <span class="count">{{ $seragam->count() }} data</span></h3>
            <button type="button" class="btn primary btn-add" data-entity="seragam">➕ Tambah Seragam</button>
          </div>
          <table>
            <thead><tr><th>#</th><th>Gambar</th><th>Nama</th><th>Deskripsi</th><th>Urutan</th><th>Aksi</th></tr></thead>
            <tbody>
              @forelse($seragam as $item)
                <tr>
                  <td class="no-cell">{{ $loop->iteration }}</td>
                  <td>
                    @if($item->foto)
                      <img src="{{ asset('storage/images/beranda/'.$item->foto) }}" class="thumb-foto">
                    @else
                      <span class="cell-empty">-</span>
                    @endif
                  </td>
                  <td>{{ $item->nama }}</td>
                  <td class="deskripsi-cell">{{ $item->deskripsi }}</td>
                  <td>{{ $item->urutan }}</td>
                  <td>
                    <button type="button" class="btn btn-edit" style="padding:5px 10px;font-size:12px;"
                      data-entity="seragam"
                      data-id="{{ $item->id }}"
                      data-nama="{{ $item->nama }}"
                      data-deskripsi="{{ $item->deskripsi }}"
                      data-urutan="{{ $item->urutan }}"
                      data-gambar="{{ $item->foto }}">✏️ Edit</button>
                    <form action="{{ route('admin.seragam.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                      @csrf @method('DELETE')
                      <button type="submit" class="btn btn-hapus" style="padding:5px 10px;font-size:12px;">🗑️ Hapus</button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr><td colspan="6" class="cell-empty-row">Belum ada data seragam.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <dialog class="crud-dialog" data-entity="seragam" data-mode="add">
          <form method="POST" action="{{ route('admin.seragam.store') }}" enctype="multipart/form-data">
            @csrf
            <h3>👔 Tambah Seragam</h3>
            <div class="field"><label>Nama Seragam</label><input type="text" name="nama" data-field="nama" placeholder="mis. Senin & Selasa" required></div>
            <div class="field"><label>Deskripsi</label><textarea name="deskripsi" data-field="deskripsi" rows="3"></textarea></div>
            <div class="field"><label>Urutan Tampil</label><input type="number" name="urutan" data-field="urutan" placeholder="0"></div>
            <div class="field"><label>Gambar</label><input type="file" name="gambar" accept="image/*"></div>
            <div class="dialog-actions">
              <button type="button" class="btn" data-close>Batal</button>
              <button type="submit" class="btn primary">💾 Simpan</button>
            </div>
          </form>
        </dialog>

        <dialog class="crud-dialog" data-entity="seragam" data-mode="edit" data-image-base="{{ asset('storage/images/beranda') }}/">
          <form method="POST" action="" enctype="multipart/form-data" class="form-edit" data-action-template="{{ route('admin.seragam.update', ':id') }}">
            @csrf @method('PUT')
            <h3>✏️ Edit Seragam</h3>
            <div class="field"><label>Nama Seragam</label><input type="text" name="nama" data-field="nama" required></div>
            <div class="field"><label>Deskripsi</label><textarea name="deskripsi" data-field="deskripsi" rows="3"></textarea></div>
            <div class="field"><label>Urutan Tampil</label><input type="number" name="urutan" data-field="urutan"></div>
            <div class="field">
              <label>Gambar</label>
              <div class="preview-wrap">
                <img data-preview="gambar" src="" alt="" style="display:none;">
                <span data-preview-empty="gambar" class="no-img">Belum ada gambar</span>
              </div>
              <input type="file" name="gambar" accept="image/*" style="margin-top:8px;">
            </div>
            <div class="dialog-actions">
              <button type="button" class="btn" data-close>Batal</button>
              <button type="submit" class="btn primary">💾 Simpan Perubahan</button>
            </div>
          </form>
        </dialog>
      </section>

      {{-- =====================================================
           TAB: ARTIKEL
      ====================================================== --}}
      <section class="admin-section {{ $activeTab === 'artikel' ? 'active' : '' }}" data-section="artikel">
        <div class="panel">
          <div class="panel-head-row">
            <h3><span class="panel-head-icon">📰</span> Daftar Artikel <span class="count">{{ $artikel->count() }} data</span></h3>
            <button type="button" class="btn primary btn-add" data-entity="artikel">➕ Tambah Berita</button>
          </div>
          <table>
            <thead><tr><th>#</th><th>Foto</th><th>Judul</th><th>Ringkasan</th><th>Aksi</th></tr></thead>
            <tbody>
              @forelse($artikel as $item)
                <tr>
                  <td class="no-cell">{{ $loop->iteration }}</td>
                  <td>@if($item->gambar)<img src="{{ asset('storage/images/artikel/'.$item->gambar) }}" class="thumb-foto">@else<span class="cell-empty">-</span>@endif</td>
                  <td>{{ $item->judul }}</td>
                  <td>{{ $item->ringkasan }}</td>
                  <td>
                    <button type="button" class="btn btn-edit" style="padding:5px 10px;font-size:12px;"
                      data-entity="artikel"
                      data-id="{{ $item->id }}"
                      data-judul="{{ $item->judul }}" data-ringkasan="{{ $item->ringkasan }}"
                      data-konten="{{ $item->konten }}"
                      data-gambar="{{ $item->gambar }}">✏️ Edit</button>
                    <form action="{{ route('admin.artikel.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                      @csrf @method('DELETE')
                      <button type="submit" class="btn btn-hapus" style="padding:5px 10px;font-size:12px;">🗑️ Hapus</button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr><td colspan="5" class="cell-empty-row">Belum ada data artikel.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <dialog class="crud-dialog" data-entity="artikel" data-mode="add">
          <form method="POST" action="{{ route('admin.artikel.store') }}" enctype="multipart/form-data">
            @csrf
            <h3>📰 Tambah Berita</h3>
            <div class="field"><label>Judul</label><input type="text" name="judul" data-field="judul" required></div>
            <div class="field"><label>Ringkasan</label><textarea name="ringkasan" data-field="ringkasan"></textarea></div>
            <div class="field"><label>Konten Lengkap</label><textarea name="konten" data-field="konten" rows="5"></textarea></div>
            <div class="field"><label>Gambar</label><input type="file" name="gambar" accept="image/*"></div>
            <div class="dialog-actions">
              <button type="button" class="btn" data-close>Batal</button>
              <button type="submit" class="btn primary">💾 Simpan</button>
            </div>
          </form>
        </dialog>

        <dialog class="crud-dialog" data-entity="artikel" data-mode="edit" data-image-base="{{ asset('storage/images/artikel') }}/">
          <form method="POST" action="" enctype="multipart/form-data" class="form-edit" data-action-template="{{ route('admin.artikel.update', ':id') }}">
            @csrf @method('PUT')
            <h3>✏️ Edit Berita</h3>
            <div class="field"><label>Judul</label><input type="text" name="judul" data-field="judul" required></div>
            <div class="field"><label>Ringkasan</label><textarea name="ringkasan" data-field="ringkasan"></textarea></div>
            <div class="field"><label>Konten Lengkap</label><textarea name="konten" data-field="konten" rows="5"></textarea></div>
            <div class="field">
              <label>Gambar</label>
              <div class="preview-wrap">
                <img data-preview="gambar" src="" alt="" style="display:none;width:56px;height:40px;object-fit:cover;border-radius:8px;background:#f2f2f2;border:1px solid #eee;">
                <span data-preview-empty="gambar" class="no-img">Belum ada gambar</span>
              </div>
              <input type="file" name="gambar" accept="image/*" style="margin-top:8px;">
            </div>
            <div class="dialog-actions">
              <button type="button" class="btn" data-close>Batal</button>
              <button type="submit" class="btn primary">💾 Simpan Perubahan</button>
            </div>
          </form>
        </dialog>
      </section>

      {{-- =====================================================
           TAB: AGENDA
      ====================================================== --}}
      <section class="admin-section {{ $activeTab === 'agenda' ? 'active' : '' }}" data-section="agenda">
        <div class="panel">
          <div class="panel-head-row">
            <h3><span class="panel-head-icon">🗓️</span> Daftar Agenda</h3>
            <button type="button" class="btn primary btn-add" data-entity="agenda">➕ Tambah Agenda</button>
          </div>
          <table>
            <thead><tr><th>#</th><th>Judul</th><th>Keterangan</th><th>Tanggal</th><th>Aksi</th></tr></thead>
            <tbody>
              @forelse($agenda as $item)
                <tr>
                  <td class="no-cell">{{ $loop->iteration }}</td>
                  <td>{{ $item->judul }}</td>
                  <td>{{ $item->keterangan }}</td>
                  <td>{{ optional($item->tanggal)->format('d M Y') }}</td>
                  <td>
                    <button type="button" class="btn btn-edit" style="padding:5px 10px;font-size:12px;"
                      data-entity="agenda"
                      data-id="{{ $item->id }}"
                      data-judul="{{ $item->judul }}" data-keterangan="{{ $item->keterangan }}"
                      data-tanggal="{{ optional($item->tanggal)->format('Y-m-d') }}">✏️ Edit</button>
                    <form action="{{ route('admin.agenda.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                      @csrf @method('DELETE')
                      <button type="submit" class="btn btn-hapus" style="padding:5px 10px;font-size:12px;">🗑️ Hapus</button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr><td colspan="5" class="cell-empty-row">Belum ada data agenda.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <dialog class="crud-dialog" data-entity="agenda" data-mode="add">
          <form method="POST" action="{{ route('admin.agenda.store') }}" enctype="multipart/form-data">
            @csrf
            <h3>🗓️ Tambah Agenda</h3>
            <div class="field"><label>Judul</label><input type="text" name="judul" data-field="judul" required></div>
            <div class="field"><label>Keterangan</label><input type="text" name="keterangan" data-field="keterangan"></div>
            <div class="field"><label>Tanggal</label><input type="date" name="tanggal" data-field="tanggal" required></div>
            <div class="dialog-actions">
              <button type="button" class="btn" data-close>Batal</button>
              <button type="submit" class="btn primary">💾 Simpan</button>
            </div>
          </form>
        </dialog>

        <dialog class="crud-dialog" data-entity="agenda" data-mode="edit">
          <form method="POST" action="" enctype="multipart/form-data" class="form-edit" data-action-template="{{ route('admin.agenda.update', ':id') }}">
            @csrf @method('PUT')
            <h3>✏️ Edit Agenda</h3>
            <div class="field"><label>Judul</label><input type="text" name="judul" data-field="judul" required></div>
            <div class="field"><label>Keterangan</label><input type="text" name="keterangan" data-field="keterangan"></div>
            <div class="field"><label>Tanggal</label><input type="date" name="tanggal" data-field="tanggal" required></div>
            <div class="dialog-actions">
              <button type="button" class="btn" data-close>Batal</button>
              <button type="submit" class="btn primary">💾 Simpan Perubahan</button>
            </div>
          </form>
        </dialog>
      </section>

      {{-- =====================================================
           TAB: PRESTASI
      ====================================================== --}}
      <section class="admin-section {{ $activeTab === 'prestasi' ? 'active' : '' }}" data-section="prestasi">
        <div class="panel">
          <div class="panel-head-row">
            <h3><span class="panel-head-icon">🏆</span> Daftar Prestasi</h3>
            <button type="button" class="btn primary btn-add" data-entity="prestasi">➕ Tambah Prestasi</button>
          </div>
          <table>
            <thead><tr><th>#</th><th>Gambar</th><th>Judul</th><th>Deskripsi</th><th>Aksi</th></tr></thead>
            <tbody>
              @forelse($prestasi as $item)
                <tr>
                  <td class="no-cell">{{ $loop->iteration }}</td>
                  <td>@if($item->gambar)<img src="{{ asset('storage/images/prestasi/'.$item->gambar) }}" class="thumb-foto">@else<span class="cell-empty">-</span>@endif</td>
                  <td>{{ $item->judul }}</td>
                  <td class="deskripsi-cell">{{ $item->deskripsi }}</td>
                  <td>
                    <button type="button" class="btn btn-edit" style="padding:5px 10px;font-size:12px;"
                      data-entity="prestasi"
                      data-id="{{ $item->id }}"
                      data-judul="{{ $item->judul }}"
                      data-deskripsi="{{ $item->deskripsi }}"
                      data-gambar="{{ $item->gambar }}">✏️ Edit</button>
                    <form action="{{ route('admin.prestasi.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                      @csrf @method('DELETE')
                      <button type="submit" class="btn btn-hapus" style="padding:5px 10px;font-size:12px;">🗑️ Hapus</button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr><td colspan="5" class="cell-empty-row">Belum ada data prestasi.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <dialog class="crud-dialog" data-entity="prestasi" data-mode="add">
          <form method="POST" action="{{ route('admin.prestasi.store') }}" enctype="multipart/form-data">
            @csrf
            <h3>🏆 Tambah Prestasi</h3>
            <div class="field"><label>Judul</label><input type="text" name="judul" data-field="judul" required></div>
            <div class="field"><label>Deskripsi</label><textarea name="deskripsi" data-field="deskripsi" rows="2"></textarea></div>
            <div class="field"><label>Gambar</label><input type="file" name="gambar" accept="image/*"></div>
            <div class="dialog-actions">
              <button type="button" class="btn" data-close>Batal</button>
              <button type="submit" class="btn primary">💾 Simpan</button>
            </div>
          </form>
        </dialog>

        <dialog class="crud-dialog" data-entity="prestasi" data-mode="edit" data-image-base="{{ asset('storage/images/prestasi') }}/">
          <form method="POST" action="" enctype="multipart/form-data" class="form-edit" data-action-template="{{ route('admin.prestasi.update', ':id') }}">
            @csrf @method('PUT')
            <h3>✏️ Edit Prestasi</h3>
            <div class="field"><label>Judul</label><input type="text" name="judul" data-field="judul" required></div>
            <div class="field"><label>Deskripsi</label><textarea name="deskripsi" data-field="deskripsi" rows="2"></textarea></div>
            <div class="field">
              <label>Gambar</label>
              <div class="preview-wrap">
                <img data-preview="gambar" src="" alt="" style="display:none;">
                <span data-preview-empty="gambar" class="no-img">Belum ada gambar</span>
              </div>
              <input type="file" name="gambar" accept="image/*" style="margin-top:8px;">
            </div>
            <div class="dialog-actions">
              <button type="button" class="btn" data-close>Batal</button>
              <button type="submit" class="btn primary">💾 Simpan Perubahan</button>
            </div>
          </form>
        </dialog>
      </section>

    </div>
  </div>
</div>

<script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>