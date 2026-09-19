// Tenaga Pendidik — lightbox for Kepala Jurusan & Guru Produktif photos
(function () {
  document.addEventListener('DOMContentLoaded', function () {
    var section = document.querySelector('.guru-section');
    if (!section) return;

    // UBAH: sembunyikan kartu yang fotonya gagal load (404) atau namanya
    // kosong, supaya tidak muncul kotak polos tanpa isi di grid.
    function pruneEmptyCards() {
      section.querySelectorAll('.guru-card, .guru-lead').forEach(function (card) {
        var nameEl = card.querySelector('.guru-card-name, .guru-lead-name');
        var img = card.querySelector('img');
        var hasName = nameEl && nameEl.textContent.trim().length > 0;

        function check() {
          if (!hasName || (img && img.naturalWidth === 0)) {
            card.style.display = 'none';
          }
        }

        if (img) {
          if (img.complete) {
            check();
          } else {
            img.addEventListener('error', check);
            img.addEventListener('load', check);
          }
        } else if (!hasName) {
          card.style.display = 'none';
        }
      });
    }
    pruneEmptyCards();

    var lightbox = document.createElement('div');
    lightbox.className = 'guru-lightbox';
    lightbox.innerHTML =
      '<button type="button" class="guru-lightbox-close" aria-label="Tutup">✕</button>' +
      '<img src="" alt="">' +
      '<div class="guru-lightbox-caption"><strong class="guru-lightbox-name"></strong>' +
      '<span class="guru-lightbox-subject"></span></div>';
    document.body.appendChild(lightbox);

    var lbImg = lightbox.querySelector('img');
    var lbName = lightbox.querySelector('.guru-lightbox-name');
    var lbSubject = lightbox.querySelector('.guru-lightbox-subject');
    var closeBtn = lightbox.querySelector('.guru-lightbox-close');
    var lastFocused = null;

    function openLightbox(trigger) {
      var img = trigger.querySelector('img');
      if (!img) return;
      lastFocused = document.activeElement;
      lbImg.src = img.src;
      lbImg.alt = img.alt || '';
      lbName.textContent = trigger.getAttribute('data-name') || img.alt || '';
      lbSubject.textContent = trigger.getAttribute('data-subject') || '';
      lightbox.classList.add('is-open');
      closeBtn.focus();
      document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
      lightbox.classList.remove('is-open');
      lbImg.src = '';
      document.body.style.overflow = '';
      if (lastFocused) lastFocused.focus();
    }

    section.querySelectorAll('.guru-lead-photo, .guru-card-photo').forEach(function (el) {
      el.setAttribute('tabindex', '0');
      el.setAttribute('role', 'button');
      el.addEventListener('click', function () { openLightbox(el); });
      el.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' || e.key === ' ') {
          e.preventDefault();
          openLightbox(el);
        }
      });
    });

    closeBtn.addEventListener('click', closeLightbox);
    lightbox.addEventListener('click', function (e) {
      if (e.target === lightbox) closeLightbox();
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && lightbox.classList.contains('is-open')) closeLightbox();
    });
  });
})();