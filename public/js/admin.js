// ==========================
// Kunci hash URL — cegah perpindahan tab lewat ketik manual di address bar
// ==========================
(function lockUrlHash() {
    if (window.location.hash) {
        history.replaceState(null, '', window.location.pathname + window.location.search);
    }
    window.addEventListener('hashchange', function () {
        history.replaceState(null, '', window.location.pathname + window.location.search);
    });
})();
/* =========================================================
   admin.js
   Konsolidasi semua <script> yang tadinya ditulis ulang di
   setiap halaman admin (agenda, berita, ekskul, galeri, guru,
   jurusan, profil) menjadi satu file generik.

   Karena semua tab sekarang berada di SATU halaman
   (admin.blade.php), id-id lama seperti #dialogAdd, #dialogEdit,
   #previewLogo dst yang dulu unik-per-halaman akan bentrok kalau
   dipakai lagi. Jadi semuanya di sini di-scope lewat atribut
   data-entity="jurusan|guru|ekskul|galeri|berita|agenda" pada
   <dialog>, tombol "+ Tambah", dan tombol "Edit" di tiap baris
   tabel.
   ========================================================= */

document.addEventListener('DOMContentLoaded', function () {
  initSidebarToggle();
  initTabSwitching();
  initCrudDialogs();
});

/* ---------------------------------------------------------
   1. Toggle sidebar (tampilan mobile)
--------------------------------------------------------- */
function initSidebarToggle() {
  var btn = document.getElementById('sidebarToggle');
  var layout = document.querySelector('.layout');
  if (!btn || !layout) return;

  btn.addEventListener('click', function () {
    layout.classList.toggle('sidebar-open');
  });
  document.getElementById('sidebarToggle')?.addEventListener('click', () => {
  document.querySelector('.admin-sidebar')?.classList.toggle('open');
});
}

/* ---------------------------------------------------------
   2. Ganti tab (Profil / Jurusan / Guru / Ekskul / Galeri /
      Berita / Agenda) tanpa reload halaman
--------------------------------------------------------- */
function initTabSwitching() {
  var links = document.querySelectorAll('.admin-tab-link[data-target]');
  var sections = document.querySelectorAll('.admin-section[data-section]');
  var titleEl = document.getElementById('adminPageTitle');

  if (!links.length || !sections.length) return;

  function activate(target, updateHash) {
    sections.forEach(function (section) {
      section.classList.toggle('active', section.dataset.section === target);
    });

    links.forEach(function (link) {
      var isActive = link.dataset.target === target;
      link.classList.toggle('active', isActive);
      if (isActive && titleEl) {
        titleEl.textContent = link.textContent.trim();
      }
    });

    if (updateHash !== false) {
      history.replaceState(null, '', '#' + target);
    }
  }

  links.forEach(function (link) {
    link.addEventListener('click', function (e) {
      e.preventDefault();
      activate(link.dataset.target);
    });
  });

  // Kalau halaman dibuka dengan hash (mis. admin/panel#berita), langsung
  // aktifkan tab tersebut.
  var initialTarget = (window.location.hash || '').replace('#', '');
  var validTargets = Array.prototype.map.call(links, function (l) { return l.dataset.target; });
  if (initialTarget && validTargets.indexOf(initialTarget) !== -1) {
    activate(initialTarget, false);
  }
}

/* ---------------------------------------------------------
   3. Dialog Tambah / Edit generik untuk semua entity
--------------------------------------------------------- */
function initCrudDialogs() {
  // Tombol "+ Tambah ..." -> buka dialog data-mode="add" milik entity terkait
  document.querySelectorAll('.btn-add[data-entity]').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var entity = btn.dataset.entity;
      var dialog = findDialog(entity, 'add');
      if (dialog) {
        var form = dialog.querySelector('form');
        if (form) form.reset();
        clearAllPreviews(dialog);
        dialog.showModal();
      }
    });
  });

  // Tombol "Edit" di setiap baris tabel -> isi & buka dialog data-mode="edit"
  document.querySelectorAll('.btn-edit[data-entity]').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var entity = btn.dataset.entity;
      var dialog = findDialog(entity, 'edit');
      if (!dialog) return;

      var form = dialog.querySelector('form.form-edit') || dialog.querySelector('form');
      if (!form) return;

      // Set action URL form dari template ".../:id"
      var template = form.dataset.actionTemplate;
      var id = btn.dataset.id;
      if (template && id) {
        form.action = template.replace(':id', id);
      }

      // Isi setiap input/select/textarea [data-field] sesuai dataset tombol
      Object.keys(btn.dataset).forEach(function (key) {
        if (key === 'entity' || key === 'id') return;
        var value = btn.dataset[key];
        var field = form.querySelector('[data-field="' + key + '"]');
        if (!field) return;

        if (field.type === 'checkbox') {
          field.checked = value === '1' || value === 'true';
        } else {
          field.value = value;
        }
      });

      // Tangani preview gambar: cari [data-preview="key"] di dalam dialog
      // dan cocokkan dengan dataset tombol (mis. data-foto, data-logo_jurusan)
      var imageBase = dialog.dataset.imageBase || '';
      dialog.querySelectorAll('[data-preview]').forEach(function (img) {
        var key = img.dataset.preview;
        var fileName = btn.dataset[key];
        var emptyLabel = dialog.querySelector('[data-preview-empty="' + key + '"]');

        if (fileName) {
          img.src = imageBase + fileName;
          img.style.display = 'block';
          if (emptyLabel) emptyLabel.style.display = 'none';
        } else {
          img.style.display = 'none';
          img.src = '';
          if (emptyLabel) emptyLabel.style.display = 'inline';
        }
      });

      dialog.showModal();
    });
  });

  // Tombol "Batal" / close di semua dialog
  document.querySelectorAll('.crud-dialog [data-close]').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var dialog = btn.closest('dialog');
      if (dialog) dialog.close();
    });
  });

  // Klik di luar konten dialog (area backdrop) -> tutup dialog
  document.querySelectorAll('dialog.crud-dialog').forEach(function (dialog) {
    dialog.addEventListener('click', function (e) {
      if (e.target === dialog) dialog.close();
    });
  });
}

function findDialog(entity, mode) {
  return document.querySelector('.crud-dialog[data-entity="' + entity + '"][data-mode="' + mode + '"]');
}

function clearAllPreviews(dialog) {
  dialog.querySelectorAll('[data-preview]').forEach(function (img) {
    img.style.display = 'none';
    img.src = '';
  });
  dialog.querySelectorAll('[data-preview-empty]').forEach(function (label) {
    label.style.display = 'inline';
  });
}