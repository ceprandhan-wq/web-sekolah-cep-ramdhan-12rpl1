// ===== TAMBAHAN: toggle search bar di topbar hero =====
// Gabungkan kode ini ke dalam dashboard.js yang sudah ada (misal di bagian
// document.addEventListener('DOMContentLoaded', ...) atau taruh di paling bawah file).

document.getElementById('btnSearchToggle')?.addEventListener('click', function () {
  document.getElementById('pvHeroSearchbar')?.classList.toggle('open');
});

// ===== TAMBAHAN: dropdown "Profil Sekolah" di navbar =====
document.getElementById('profilDropdownToggle')?.addEventListener('click', function (e) {
  e.preventDefault();
  document.getElementById('profilDropdown')?.classList.toggle('open');
});

// Tutup dropdown saat klik di luar area dropdown
document.addEventListener('click', function (e) {
  const dropdown = document.getElementById('profilDropdown');
  if (dropdown && !dropdown.contains(e.target)) {
    dropdown.classList.remove('open');
  }
});

// Klik salah satu item submenu -> pindah ke halaman "profil" (sesuaikan dengan
// fungsi navigasi tab yang sudah ada di dashboard.js, misal showPage('profil'))
document.querySelectorAll('.nav-dropdown-item').forEach(function (item) {
  item.addEventListener('click', function (e) {
    e.preventDefault();
    document.getElementById('profilDropdown')?.classList.remove('open');
    // TODO: panggil fungsi tab-switch yang sudah ada, contoh:
    // showPage(this.dataset.page);
  });
});