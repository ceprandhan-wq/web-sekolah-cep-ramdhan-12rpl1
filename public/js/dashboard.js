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

// ==========================
// Replay animasi fade-up judul & tagline hero Beranda
// Dipanggil setiap kali halaman Beranda ditampilkan ulang,
// supaya animasinya terasa sama seperti pertama kali masuk web.
// ==========================
function replayHeroAnimation() {
    var title = document.querySelector('.pv-hero-title');
    var tagline = document.querySelector('.pv-hero-tagline');

    [title, tagline].forEach(function (el) {
        if (!el) return;
        el.style.animation = 'none';
        // paksa reflow supaya browser "lupa" state animasi sebelumnya
        void el.offsetWidth;
        el.style.animation = '';
    });
}

// ==========================
// Routing menu (topbar, SPA-style tab switch)
// Catatan: menu "Profil Sekolah" sekarang punya dropdown (lihat blok
// "Dropdown menu Profil Sekolah" di bawah), tapi tetap ikut sistem
// routing utama ini untuk pindah section halaman.
// ==========================
document.addEventListener('DOMContentLoaded', function () {
    const items = document.querySelectorAll('.menu-item[data-page]');
    const pages = document.querySelectorAll('.page');
    const titleEl = document.getElementById('topbarTitle');
    const titles = {
        beranda: 'Beranda <span>/ dashboard</span>',
        profil: 'Profil Sekolah <span>/ pengaturan</span>',
        jurusan: 'Jurusan <span>/ data sekolah</span>',
        berita: 'Berita <span>/ informasi</span>',
        pasilitas: 'Fasilitas <span>/ sarana prasarana</span>',
        guru: 'Guru & Staff <span>/ data sekolah</span>',
        ekstrakurikuler: 'Ekstrakurikuler <span>/ data sekolah</span>',
        kontak: 'Kontak <span>/ hubungi kami</span>',
    };

    function gotoPage(target) {
        const targetPage = document.getElementById('page-' + target);
        if (!targetPage) {
            console.warn('Section "page-' + target + '" belum ada di blade.');
            return;
        }

        items.forEach(i => i.classList.toggle('active', i.dataset.page === target));
        pages.forEach(p => p.classList.remove('active'));
        targetPage.classList.add('active');
        titleEl.innerHTML = titles[target] || target;

        if (target === 'beranda') {
            replayHeroAnimation();
        }
    }

    items.forEach(item => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            gotoPage(item.dataset.page);
        });
    });

    window.__pvGotoPage = gotoPage;
    window.__pvPageTitles = titles;
});

      // ==========================
// Modal Galeri Video (Beranda) — klik kartu video untuk memutar
// ==========================
function openVideoModal(card) {
    const overlay = document.getElementById('pvVideoModal');
    const frame = document.getElementById('pvVideoModalFrame');
    if (!overlay || !frame || !card) return;

    const youtubeId = card.dataset.videoYoutube;
    const url = card.dataset.videoUrl;

    if (youtubeId) {
        frame.innerHTML = '<iframe src="https://www.youtube.com/embed/' + youtubeId +
            '?autoplay=1&rel=0" title="' + (card.dataset.videoTitle || 'Video') +
            '" allow="autoplay; encrypted-media; picture-in-picture" allowfullscreen></iframe>';
    } else if (url) {
        frame.innerHTML = '<video src="' + url + '" controls autoplay></video>';
    } else {
        frame.innerHTML = '<div style="color:#fff;display:flex;align-items:center;justify-content:center;height:100%;font-size:13px;">Video belum tersedia.</div>';
    }

    overlay.classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closeVideoModal() {
    const overlay = document.getElementById('pvVideoModal');
    const frame = document.getElementById('pvVideoModalFrame');
    if (!overlay) return;

    overlay.classList.remove('open');
    if (frame) frame.innerHTML = '';
    document.body.style.overflow = '';
}

document.addEventListener('DOMContentLoaded', function () {
    document.addEventListener('click', function (e) {
        const card = e.target.closest('.pv-galeri-video-card');
        if (card) openVideoModal(card);
    });

    const overlay = document.getElementById('pvVideoModal');
    if (overlay) {
        overlay.addEventListener('click', function (e) {
            if (e.target === overlay) closeVideoModal();
        });
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeVideoModal();
    });
});

window.openVideoModal = openVideoModal;
window.closeVideoModal = closeVideoModal;

// ==========================
// Helper: posisikan dropdown menu (position:fixed) tepat di bawah tombol
// toggle-nya. Dipakai supaya dropdown selalu "melayang" di atas konten,
// tidak pernah kepotong oleh overflow container manapun (header, nav, dst).
// align: 'center' -> menu dipusatkan di bawah toggle (dipakai Profil Sekolah)
//        'left'   -> sisi kiri menu sejajar sisi kiri toggle (dipakai Jurusan)
// ==========================
function positionFixedDropdown(toggleEl, menuEl, align) {
    const r = toggleEl.getBoundingClientRect();
    const gap = 10;
    const menuWidth = menuEl.offsetWidth || menuEl.getBoundingClientRect().width;

    let left;
    if (align === 'center') {
        left = r.left + (r.width / 2) - (menuWidth / 2);
    } else {
        left = r.left;
    }

    // Jaga supaya dropdown tidak keluar dari tepi layar
    const margin = 8;
    const maxLeft = window.innerWidth - menuWidth - margin;
    left = Math.max(margin, Math.min(left, maxLeft));

    menuEl.style.left = left + 'px';
    menuEl.style.top = (r.bottom + gap) + 'px';
}

// ==========================
// Dropdown menu "Jurusan" — daftar jurusan langsung dari nav
// ==========================
document.addEventListener('DOMContentLoaded', function () {
    const dropdown = document.getElementById('navDropdownJurusan');
    if (!dropdown) return;

    const toggle = dropdown.querySelector('.dropdown-toggle');
    const menu = dropdown.querySelector('.nav-dropdown-menu-simple');

    function openDropdown() {
        dropdown.classList.add('open');
        positionFixedDropdown(toggle, menu, 'left');
    }

    function closeDropdown() {
        dropdown.classList.remove('open');
    }

    // Buka dropdown langsung saat mouse diarahkan ke "Kompetensi Keahlian"
    dropdown.addEventListener('mouseenter', function () {
        openDropdown();
    });

    // Cegah link toggle ikut ter-klik/pindah halaman (karena sudah dibuka via hover)
    toggle.addEventListener('click', function (e) {
        e.preventDefault();
    });

    // Navigasi manual untuk tiap item jurusan
    menu.querySelectorAll('.nav-dropdown-item-simple').forEach(function (item) {
        item.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            const href = item.getAttribute('href');
            closeDropdown();
            if (href) {
                window.location.href = href;
            }
        });
    });

    // Dropdown tertutup saat mouse keluar dari areanya
    dropdown.addEventListener('mouseleave', function () {
        closeDropdown();
    });

    // Reposisi ulang saat ukuran layar berubah (tanpa menutup dropdown)
    window.addEventListener('resize', function () {
        if (dropdown.classList.contains('open')) positionFixedDropdown(toggle, menu, 'left');
    });
});

// ==========================
// Tombol Cari — buka/tutup search bar di header
// ==========================
document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('btnSearchToggle');
    const bar = document.getElementById('pvHeroSearchbar');
    if (!btn || !bar) return;

    const input = document.getElementById('pvHeroSearchInput');
    const submitBtn = document.getElementById('pvHeroSearchSubmit');

    btn.addEventListener('click', function (e) {
        e.stopPropagation();
        bar.classList.toggle('open');
        if (bar.classList.contains('open') && input) {
            input.focus();
        }
    });

    // Tutup search bar kalau klik di luar area search
    document.addEventListener('click', function (e) {
        if (!bar.contains(e.target) && e.target !== btn && !btn.contains(e.target)) {
            bar.classList.remove('open');
        }
    });

    function doSearch() {
        const q = (input && input.value ? input.value.trim() : '');
        if (!q) return;
        console.log('Mencari:', q);
    }

    if (submitBtn) submitBtn.addEventListener('click', doSearch);
    if (input) {
        input.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                doSearch();
            }
        });
    }
});

// ==========================
// Tombol Notifikasi — buka/tutup panel notifikasi
// ==========================
document.addEventListener('DOMContentLoaded', function () {
    const wrap = document.getElementById('notifWrap');
    const btn = document.getElementById('btnNotifToggle');
    const panel = document.getElementById('notifPanel');
    if (!wrap || !btn || !panel) return;

    btn.addEventListener('click', function (e) {
        e.stopPropagation();
        panel.classList.toggle('open');
    });

    document.addEventListener('click', function (e) {
        if (!wrap.contains(e.target)) {
            panel.classList.remove('open');
        }
    });
});

// ==========================
// Jam & tanggal berjalan di hero (pratinjau beranda publik)
// ==========================
document.addEventListener('DOMContentLoaded', function () {
    const dateEl = document.getElementById('pvHeroDate');
    const timeEl = document.getElementById('pvHeroTime');
    if (!dateEl || !timeEl) return;

    function pad(n) { return n.toString().padStart(2, '0'); }
    function ordinal(n) {
        if (n > 3 && n < 21) return 'th';
        switch (n % 10) { case 1: return 'st'; case 2: return 'nd'; case 3: return 'rd'; default: return 'th'; }
    }

    function tick() {
        const now = new Date();
        const days = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
        const months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        const day = days[now.getDay()];
        const month = months[now.getMonth()];
        const date = now.getDate();
        const year = now.getFullYear();

        dateEl.textContent = `${day}. ${month} ${date}${ordinal(date)}, ${year}`;
        timeEl.textContent = `${pad(now.getHours())}.${pad(now.getMinutes())}.${pad(now.getSeconds())}`;
    }

    tick();
    setInterval(tick, 1000);
});

// ==========================
// Slideshow otomatis hero banner Beranda (fade, tanpa perlu diklik)
// Foto berganti sendiri: gerbang sekolah -> upacara -> hormat -> ulang.
// Dipakai di header .pv-hero-banner (tampil di semua halaman).
// ==========================
(function () {
    const SLIDE_DELAY = 5000; // jeda antar foto (ms)
    let slideInterval = null;
    let currentIndex = 0;

    function getSlides() {
        const banner = document.getElementById('pvHeroBanner');
        return banner ? Array.from(banner.querySelectorAll('.pv-hero-slide')) : [];
    }

    function showSlide(index) {
        const slides = getSlides();
        if (!slides.length) return;
        slides.forEach((s, i) => s.classList.toggle('active', i === index));
        currentIndex = index;
    }

    function nextSlide() {
        const slides = getSlides();
        if (slides.length < 2) return;
        showSlide((currentIndex + 1) % slides.length);
    }

    function stopSlideshow() {
        if (slideInterval) {
            clearInterval(slideInterval);
            slideInterval = null;
        }
    }

    function startSlideshow() {
        stopSlideshow();
        const slides = getSlides();
        if (slides.length < 2) return; // tidak perlu autoplay kalau cuma 1 foto
        slideInterval = setInterval(nextSlide, SLIDE_DELAY);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', startSlideshow);
    } else {
        startSlideshow();
    }
})();

// ==========================
// Helper AJAX submit form (support upload file / FormData)
// ==========================
async function postForm(url, formData, method = 'POST') {
    if (method !== 'POST') {
        formData.append('_method', method);
    }

    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    formData.append('_token', token);

    const response = await fetch(url, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
        },
        body: formData,
    });

    const data = await response.json().catch(() => null);

    if (!response.ok) {
        throw { status: response.status, data };
    }

    return data;
}

// ==========================
// Submit form profil sekolah
// ==========================
document.addEventListener('DOMContentLoaded', function () {
    const formProfil = document.getElementById('form-profil');

    if (!formProfil) return;

    formProfil.addEventListener('submit', async function (e) {
        e.preventDefault();

        const submitBtn = formProfil.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Menyimpan...';

        try {
            const formData = new FormData(formProfil);
            const result = await postForm(
                formProfil.getAttribute('action'),
                formData,
                'PUT'
            );

            showAlert('success', result.message);

            if (result.data && result.data.logo) {
                const logoPreview = document.getElementById('logo-preview');
                if (logoPreview) {
                    logoPreview.src = '/storage/' + result.data.logo + '?t=' + Date.now();
                }
            }
        } catch (err) {
            if (err.status === 422 && err.data && err.data.errors) {
                const errors = Object.values(err.data.errors).flat().join('\n');
                showAlert('error', errors);
            } else {
                showAlert('error', 'Terjadi kesalahan, coba lagi.');
            }
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        }
    });
});

// ==========================
// Helper notifikasi sederhana
// ==========================
function showAlert(type, message) {
    const alertBox = document.getElementById('alert-box');
    if (!alertBox) {
        alert(message);
        return;
    }

    alertBox.textContent = message;
    alertBox.className = type === 'success' ? 'alert alert-success' : 'alert alert-error';
    alertBox.style.display = 'block';

    setTimeout(() => {
        alertBox.style.display = 'none';
    }, 3000);
}


// ==========================
// Carousel Jurusan (highlight kartu tengah + tombol navigasi + autoplay + DRAG/SWIPE)
// Dipakai di PAGE: JURUSAN.
// ==========================
(function () {
    const AUTOPLAY_DELAY = 3000;
    const RESUME_DELAY   = 4000;
    const DRAG_CLICK_THRESHOLD = 6;

    let autoplayInterval = null;
    let resumeTimeout = null;

    let isDragging = false;
    let didDrag = false;
    let pointerId = null;
    let dragStartX = 0;
    let dragScrollStart = 0;

    function getTrack() {
        return document.getElementById('jurusanTrack');
    }

    function getCards(track) {
        return track ? Array.from(track.querySelectorAll('.pv-jurusan-carousel-card')) : [];
    }

    function isVisible(el) {
        return !!(el && el.offsetParent !== null && el.offsetWidth > 0);
    }

    function updateActiveCard() {
        const track = getTrack();
        if (!isVisible(track)) return;

        const trackRect = track.getBoundingClientRect();
        const center = trackRect.left + trackRect.width / 2;
        let closest = null;
        let closestDist = Infinity;

        getCards(track).forEach(card => {
            const r = card.getBoundingClientRect();
            const cardCenter = r.left + r.width / 2;
            const dist = Math.abs(cardCenter - center);
            card.classList.remove('active');
            if (dist < closestDist) {
                closestDist = dist;
                closest = card;
            }
        });

        if (closest) closest.classList.add('active');
    }

    function snapToNearestCard(track) {
        const cards = getCards(track);
        if (!cards.length) return;

        const viewportCenter = track.scrollLeft + track.clientWidth / 2;
        let nearestIndex = 0;
        let nearestDist = Infinity;

        cards.forEach((card, i) => {
            const cardCenter = card.offsetLeft + card.offsetWidth / 2;
            const dist = Math.abs(cardCenter - viewportCenter);
            if (dist < nearestDist) {
                nearestDist = dist;
                nearestIndex = i;
            }
        });

        const target = cards[nearestIndex];
        const targetScrollLeft = target.offsetLeft + target.offsetWidth / 2 - track.clientWidth / 2;
        const maxScroll = track.scrollWidth - track.clientWidth;
        const clamped = Math.max(0, Math.min(targetScrollLeft, maxScroll));

        track.scrollTo({ left: clamped, behavior: 'smooth' });
    }

    function cardStep(track) {
        const list = getCards(track);
        if (!list.length) return 0;
        const gap = parseFloat(getComputedStyle(track).columnGap || getComputedStyle(track).gap || '22') || 22;
        return list[0].getBoundingClientRect().width + gap;
    }

    function scrollByCard(direction) {
        const track = getTrack();
        if (!isVisible(track)) return;
        const step = cardStep(track);
        if (!step) return;
        track.scrollBy({ left: direction * step, behavior: 'smooth' });
    }

    function scrollToNextLooped() {
        const track = getTrack();
        if (!isVisible(track)) return;
        const maxScroll = track.scrollWidth - track.clientWidth;
        if (maxScroll <= 0) return;
        if (track.scrollLeft >= maxScroll - 4) {
            track.scrollTo({ left: 0, behavior: 'smooth' });
        } else {
            scrollByCard(1);
        }
    }

    function stopAutoplay() {
        if (autoplayInterval) {
            clearInterval(autoplayInterval);
            autoplayInterval = null;
        }
    }

    function startAutoplay() {
        stopAutoplay();
        autoplayInterval = setInterval(function () {
            const track = getTrack();
            if (isVisible(track)) {
                scrollToNextLooped();
            }
        }, AUTOPLAY_DELAY);
    }

    function pauseAutoplayTemporarily() {
        stopAutoplay();
        clearTimeout(resumeTimeout);
        resumeTimeout = setTimeout(startAutoplay, RESUME_DELAY);
    }

    document.addEventListener('click', function (e) {
        if (didDrag) {
            didDrag = false;
            return;
        }
        const prevBtn = e.target.closest('#jurusanPrev');
        const nextBtn = e.target.closest('#jurusanNext');
        if (prevBtn) {
            e.preventDefault();
            scrollByCard(-1);
            pauseAutoplayTemporarily();
        } else if (nextBtn) {
            e.preventDefault();
            scrollByCard(1);
            pauseAutoplayTemporarily();
        }
    });

    document.addEventListener('scroll', function (e) {
        if (e.target && e.target.id === 'jurusanTrack') {
            window.requestAnimationFrame(updateActiveCard);
        }
    }, true);

    document.addEventListener('pointerdown', function (e) {
        const track = e.target.closest('#jurusanTrack');
        if (!track) return;

        isDragging = true;
        didDrag = false;
        pointerId = e.pointerId;
        dragStartX = e.clientX;
        dragScrollStart = track.scrollLeft;

        track.classList.add('dragging');
        track.style.scrollSnapType = 'none';
        track.style.scrollBehavior = 'auto';

        try { track.setPointerCapture(pointerId); } catch (err) { /* ignore */ }

        pauseAutoplayTemporarily();
    });

    document.addEventListener('pointermove', function (e) {
        if (!isDragging || e.pointerId !== pointerId) return;
        const track = getTrack();
        if (!track) return;

        const dx = e.clientX - dragStartX;

        if (Math.abs(dx) > DRAG_CLICK_THRESHOLD) {
            didDrag = true;
        }

        if (e.cancelable) {
            e.preventDefault();
        }

        track.scrollLeft = dragScrollStart - dx;
    });

    function endDrag(e) {
        if (!isDragging) return;
        if (pointerId !== null && e && e.pointerId !== undefined && e.pointerId !== pointerId) return;

        isDragging = false;
        const track = getTrack();
        if (track) {
            track.classList.remove('dragging');
            track.style.scrollSnapType = '';
            track.style.scrollBehavior = '';

            if (pointerId !== null) {
                try { track.releasePointerCapture(pointerId); } catch (err) { /* ignore */ }
            }

            window.requestAnimationFrame(function () {
                snapToNearestCard(track);
            });
        }
        pointerId = null;
    }

    document.addEventListener('pointerup', endDrag);
    document.addEventListener('pointercancel', endDrag);

    document.addEventListener('mouseover', function (e) {
        if (e.target.closest('.pv-jurusan-carousel-wrap')) {
            stopAutoplay();
        }
    });
    document.addEventListener('mouseout', function (e) {
        const wrap = e.target.closest('.pv-jurusan-carousel-wrap');
        if (wrap && !wrap.contains(e.relatedTarget)) {
            clearTimeout(resumeTimeout);
            startAutoplay();
        }
    });

    function watchJurusanPage() {
        const pageJurusan = document.getElementById('page-jurusan');
        if (!pageJurusan) return;

        const observer = new MutationObserver(function () {
            if (pageJurusan.classList.contains('active')) {
                setTimeout(function () {
                    updateActiveCard();
                    startAutoplay();
                }, 150);
            } else {
                stopAutoplay();
            }
        });

        observer.observe(pageJurusan, { attributes: true, attributeFilter: ['class'] });

        if (pageJurusan.classList.contains('active')) {
            setTimeout(function () {
                updateActiveCard();
                startAutoplay();
            }, 150);
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', watchJurusanPage);
    } else {
        watchJurusanPage();
    }
})();

// ==========================
// Lightbox foto — klik gambar (mis. foto berita) untuk melihat versi penuh
// Dipakai lewat atribut onclick="openLightbox(this.src, this.alt)" di <img>,
// atau otomatis untuk semua <img data-lightbox> lewat delegasi klik di bawah.
// ==========================
function openLightbox(src, alt) {
    const overlay = document.getElementById('pvLightbox');
    const img = document.getElementById('pvLightboxImg');
    if (!overlay || !img || !src) return;

    img.src = src;
    img.alt = alt || '';
    overlay.classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    const overlay = document.getElementById('pvLightbox');
    const img = document.getElementById('pvLightboxImg');
    if (!overlay) return;

    overlay.classList.remove('open');
    if (img) img.src = '';
    document.body.style.overflow = '';
}

document.addEventListener('DOMContentLoaded', function () {
    const overlay = document.getElementById('pvLightbox');
    if (!overlay) return;

    // Klik area gelap di luar foto -> tutup
    overlay.addEventListener('click', function (e) {
        if (e.target === overlay) closeLightbox();
    });

    // Tombol close (x)
    const closeBtn = overlay.querySelector('.pv-lightbox-close');
    if (closeBtn) {
        closeBtn.addEventListener('click', function (e) {
            e.preventDefault();
            closeLightbox();
        });
    }

    // Tutup dengan tombol Escape
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeLightbox();
    });

    // Delegasi: foto mana pun yang diberi atribut data-lightbox otomatis bisa diklik,
    // tanpa perlu menambahkan onclick manual satu per satu di setiap <img>.
    document.addEventListener('click', function (e) {
        const img = e.target.closest('img[data-lightbox]');
        if (img) {
            openLightbox(img.currentSrc || img.src, img.alt);
        }
    });
});

window.openLightbox = openLightbox;
window.closeLightbox = closeLightbox;
// ==========================
// Carousel Seragam Sekolah (Beranda) — autoplay + tombol panah + drag/swipe
// Dipakai di section "Seragam Sekolah" (#seragamTrack, #seragamPrev, #seragamNext)
// ==========================
(function () {
    const AUTOPLAY_DELAY = 3200;
    const RESUME_DELAY   = 4500;
    const DRAG_CLICK_THRESHOLD = 6;

    let autoplayInterval = null;
    let resumeTimeout = null;

    let isDragging = false;
    let didDrag = false;
    let pointerId = null;
    let dragStartX = 0;
    let dragScrollStart = 0;
    let dragStartImg = null; // foto (data-lightbox) yang ditekan saat pointerdown

    function getTrack() {
        return document.getElementById('seragamTrack');
    }

    function isVisible(el) {
        return !!(el && el.offsetParent !== null && el.offsetWidth > 0);
    }

    function cardStep(track) {
        const card = track.querySelector('.pv-seragam-card');
        if (!card) return 0;
        const gap = parseFloat(getComputedStyle(track).columnGap || getComputedStyle(track).gap || '18') || 18;
        return card.getBoundingClientRect().width + gap;
    }

    function scrollByCard(direction) {
        const track = getTrack();
        if (!isVisible(track)) return;
        const step = cardStep(track);
        if (!step) return;
        track.scrollBy({ left: direction * step, behavior: 'smooth' });
    }

    // Geser otomatis ke kanan; kalau sudah mentok, balik lagi ke awal (loop)
    function scrollToNextLooped() {
        const track = getTrack();
        if (!isVisible(track)) return;
        const maxScroll = track.scrollWidth - track.clientWidth;
        if (maxScroll <= 0) return; // semua kartu sudah muat, tidak perlu geser
        if (track.scrollLeft >= maxScroll - 4) {
            track.scrollTo({ left: 0, behavior: 'smooth' });
        } else {
            scrollByCard(1);
        }
    }

    function stopAutoplay() {
        if (autoplayInterval) {
            clearInterval(autoplayInterval);
            autoplayInterval = null;
        }
    }

    function startAutoplay() {
        stopAutoplay();
        autoplayInterval = setInterval(function () {
            const track = getTrack();
            if (isVisible(track)) {
                scrollToNextLooped();
            }
        }, AUTOPLAY_DELAY);
    }

    function pauseAutoplayTemporarily() {
        stopAutoplay();
        clearTimeout(resumeTimeout);
        resumeTimeout = setTimeout(startAutoplay, RESUME_DELAY);
    }

    // Tombol panah kiri/kanan
    document.addEventListener('click', function (e) {
        if (didDrag) {
            didDrag = false;
            return;
        }
        const prevBtn = e.target.closest('#seragamPrev');
        const nextBtn = e.target.closest('#seragamNext');
        if (prevBtn) {
            e.preventDefault();
            scrollByCard(-1);
            pauseAutoplayTemporarily();
        } else if (nextBtn) {
            e.preventDefault();
            scrollByCard(1);
            pauseAutoplayTemporarily();
        }
    });

    // Drag / swipe manual dengan mouse atau jari
    document.addEventListener('pointerdown', function (e) {
        const track = e.target.closest('#seragamTrack');
        if (!track) return;

        isDragging = true;
        didDrag = false;
        pointerId = e.pointerId;
        dragStartX = e.clientX;
        dragScrollStart = track.scrollLeft;
        dragStartImg = e.target.closest('img[data-lightbox]'); // ingat foto yang ditekan

        track.classList.add('dragging');
        track.style.scrollSnapType = 'none';
        track.style.scrollBehavior = 'auto';

        try { track.setPointerCapture(pointerId); } catch (err) { /* ignore */ }

        pauseAutoplayTemporarily();
    });

    document.addEventListener('pointermove', function (e) {
        if (!isDragging || e.pointerId !== pointerId) return;
        const track = getTrack();
        if (!track) return;

        const dx = e.clientX - dragStartX;
        if (Math.abs(dx) > DRAG_CLICK_THRESHOLD) {
            didDrag = true;
        }
        if (e.cancelable) e.preventDefault();
        track.scrollLeft = dragScrollStart - dx;
    });

    function endDrag(e) {
        if (!isDragging) return;
        if (pointerId !== null && e && e.pointerId !== undefined && e.pointerId !== pointerId) return;

        isDragging = false;
        const track = getTrack();
        if (track) {
            track.classList.remove('dragging');
            track.style.scrollSnapType = '';
            track.style.scrollBehavior = '';
            if (pointerId !== null) {
                try { track.releasePointerCapture(pointerId); } catch (err) { /* ignore */ }
            }
        }

        // Kalau tidak ada gerakan drag (cuma tap/klik) dan itu mengenai foto,
        // buka lightbox secara langsung — karena event 'click' bawaan browser
        // bisa "salah sasaran" saat pointer capture aktif.
        if (!didDrag && dragStartImg && typeof window.openLightbox === 'function') {
            window.openLightbox(dragStartImg.currentSrc || dragStartImg.src, dragStartImg.alt);
        }

        dragStartImg = null;
        pointerId = null;
    }

    document.addEventListener('pointerup', endDrag);
    document.addEventListener('pointercancel', endDrag);

    // Pause saat kursor berada di atas carousel
    document.addEventListener('mouseover', function (e) {
        if (e.target.closest('.pv-seragam-carousel-wrap')) {
            stopAutoplay();
        }
    });
    document.addEventListener('mouseout', function (e) {
        const wrap = e.target.closest('.pv-seragam-carousel-wrap');
        if (wrap && !wrap.contains(e.relatedTarget)) {
            clearTimeout(resumeTimeout);
            startAutoplay();
        }
    });

    // Hanya jalan autoplay saat halaman Beranda sedang aktif
    function watchBerandaPage() {
        const pageBeranda = document.getElementById('page-beranda');
        if (!pageBeranda) return;

        const observer = new MutationObserver(function () {
            if (pageBeranda.classList.contains('active')) {
                setTimeout(startAutoplay, 150);
            } else {
                stopAutoplay();
            }
        });
        observer.observe(pageBeranda, { attributes: true, attributeFilter: ['class'] });

        if (pageBeranda.classList.contains('active')) {
            setTimeout(startAutoplay, 150);
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', watchBerandaPage);
    } else {
        watchBerandaPage();
    }
    
})();


// ==========================
// Navigasi halaman artikel: panah kiri/kanan + nomor halaman + autoplay
// ==========================
document.addEventListener('DOMContentLoaded', function () {
    const nav = document.getElementById('artikelNav');
    const list = document.getElementById('artikelList');
    if (!nav || !list) return;

    const cards = list.querySelectorAll('.pv-artikel-card');
    const numberBtns = nav.querySelectorAll('.pv-artikel-num');
    const btnPrev = document.getElementById('artikelPrev');
    const btnNext = document.getElementById('artikelNext');
    const totalPage = parseInt(nav.dataset.total, 10) || 1;

    const AUTOPLAY_DELAY = 4500;
    const RESUME_DELAY = 6000;

    let currentPage = 1;
    let autoplayInterval = null;
    let resumeTimeout = null;

    function showBeritaPage(page) {
        currentPage = page;
        cards.forEach(function (card) {
            card.style.display = (card.dataset.page === String(page)) ? '' : 'none';
        });
        numberBtns.forEach(function (btn) {
            btn.classList.toggle('active', btn.dataset.page === String(page));
        });
    }

    function nextPage() {
        const next = currentPage >= totalPage ? 1 : currentPage + 1;
        showBeritaPage(next);
    }

    function prevPage() {
        const prev = currentPage <= 1 ? totalPage : currentPage - 1;
        showBeritaPage(prev);
    }

    function stopAutoplay() {
        if (autoplayInterval) {
            clearInterval(autoplayInterval);
            autoplayInterval = null;
        }
    }

    function startAutoplay() {
        stopAutoplay();
        autoplayInterval = setInterval(nextPage, AUTOPLAY_DELAY);
    }

    function pauseAutoplayTemporarily() {
        stopAutoplay();
        clearTimeout(resumeTimeout);
        resumeTimeout = setTimeout(startAutoplay, RESUME_DELAY);
    }

    if (btnPrev) {
        btnPrev.addEventListener('click', function () {
            prevPage();
            pauseAutoplayTemporarily();
        });
    }
    if (btnNext) {
        btnNext.addEventListener('click', function () {
            nextPage();
            pauseAutoplayTemporarily();
        });
    }
    numberBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            showBeritaPage(btn.dataset.page);
            pauseAutoplayTemporarily();
        });
    });

    nav.closest('.pv-artikel-grid-wrap').addEventListener('mouseenter', stopAutoplay);
    nav.closest('.pv-artikel-grid-wrap').addEventListener('mouseleave', function () {
        clearTimeout(resumeTimeout);
        startAutoplay();
    });

    startAutoplay();
});

// ==========================
// Counter statistik sekolah (Beranda) — jalan saat discroll ke bagiannya
// ==========================
document.addEventListener('DOMContentLoaded', function () {
    const statCard = document.querySelector('.pv-statistik-card');
    if (!statCard) return;

    const COUNT_DURATION = 1400;
    let hasRun = false;

    function easeOutQuint(t) {
        return 1 - Math.pow(1 - t, 5);
    }

    function animateValue(el, target, duration) {
        const start = performance.now();

        function step(now) {
            const progress = Math.min((now - start) / duration, 1);
            const eased = easeOutQuint(progress);
            const current = Math.round(eased * target);
            el.textContent = current.toLocaleString('id-ID');

            if (progress < 1) {
                requestAnimationFrame(step);
            } else {
                el.textContent = target.toLocaleString('id-ID');
            }
        }

        requestAnimationFrame(step);
    }

    function runStatCounters() {
        if (hasRun) return;
        hasRun = true;

        const values = statCard.querySelectorAll('.pv-artikel-stat-value[data-count-target]');
        values.forEach(function (el) {
            const target = parseInt(el.dataset.countTarget, 10) || 0;
            el.textContent = '0';
            animateValue(el, target, COUNT_DURATION);
        });
    }

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                runStatCounters();
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.4 // mulai menghitung saat 40% kartu sudah kelihatan
    });

    observer.observe(statCard);
});
// ==========================
// Navigasi & autoplay grid Guru & Staff
// ==========================
document.addEventListener('DOMContentLoaded', function () {
    const nav = document.getElementById('guruNav');
    const grid = document.getElementById('guruPageGrid');
    if (!nav || !grid) return;

    const cards = grid.querySelectorAll('.pv-guru-page-card');
    const btnPrev = document.getElementById('guruPrev');
    const btnNext = document.getElementById('guruNext');
    const totalPage = parseInt(nav.dataset.total, 10) || 1;

    const AUTOPLAY_DELAY = 4000;
    const RESUME_DELAY   = 6000;

    let currentPage = 1;
    let autoplayInterval = null;
    let resumeTimeout = null;

    function showGuruPage(page) {
        currentPage = page;
        cards.forEach(function (card) {
            card.style.display = (card.dataset.page === String(page)) ? '' : 'none';
        });
    }

    function nextPage() {
        const next = currentPage >= totalPage ? 1 : currentPage + 1;
        showGuruPage(next);
    }

    function prevPage() {
        const prev = currentPage <= 1 ? totalPage : currentPage - 1;
        showGuruPage(prev);
    }

    function stopAutoplay() {
        if (autoplayInterval) {
            clearInterval(autoplayInterval);
            autoplayInterval = null;
        }
    }

    function startAutoplay() {
        stopAutoplay();
        if (totalPage < 2) return;
        autoplayInterval = setInterval(nextPage, AUTOPLAY_DELAY);
    }

    function pauseAutoplayTemporarily() {
        stopAutoplay();
        clearTimeout(resumeTimeout);
        resumeTimeout = setTimeout(startAutoplay, RESUME_DELAY);
    }

    if (btnPrev) {
        btnPrev.addEventListener('click', function () {
            prevPage();
            pauseAutoplayTemporarily();
        });
    }
    if (btnNext) {
        btnNext.addEventListener('click', function () {
            nextPage();
            pauseAutoplayTemporarily();
        });
    }

    grid.addEventListener('mouseenter', stopAutoplay);
    grid.addEventListener('mouseleave', function () {
        clearTimeout(resumeTimeout);
        startAutoplay();
    });

    startAutoplay();
});

// ==========================
// Toggle "Lihat Semua Pegawai"
// ==========================
document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('guruViewAllBtn');
    const grid = document.getElementById('guruPageGrid');
    const nav = document.getElementById('guruNav');
    if (!btn || !grid) return;

    let showingAll = false;

    btn.addEventListener('click', function (e) {
        e.preventDefault();
        showingAll = !showingAll;

        const cards = grid.querySelectorAll('.pv-guru-page-card');

        if (showingAll) {
            cards.forEach(function (card) {
                card.style.display = '';
            });
            if (nav) nav.style.display = 'none';
            btn.textContent = 'Tampilkan Lebih Sedikit';
        } else {
            cards.forEach(function (card) {
                card.style.display = (card.dataset.page === '1') ? '' : 'none';
            });
            if (nav) nav.style.display = '';
            btn.textContent = 'Lihat Semua Pegawai';
        }
    });
});

// ==========================
// Toggle "Lihat Semua Berita"
// ==========================
document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('artikelViewAllBtn');
    const list = document.getElementById('artikelList');
    const nav = document.getElementById('artikelNav');
    if (!btn || !list) return;

    let showingAll = false;

    btn.addEventListener('click', function (e) {
        e.preventDefault();
        showingAll = !showingAll;

        const cards = list.querySelectorAll('.pv-artikel-card');

        if (showingAll) {
            cards.forEach(function (card) {
                card.style.display = '';
            });
            if (nav) nav.style.display = 'none';
            btn.textContent = 'Tampilkan Lebih Sedikit';
        } else {
            cards.forEach(function (card) {
                card.style.display = (card.dataset.page === '1') ? '' : 'none';
            });
            if (nav) nav.style.display = '';
            btn.textContent = 'Lihat Semua Berita →';
        }
    });
});

// ==========================
// Ganti teks judul & tagline hero sesuai halaman aktif
// ==========================
document.addEventListener('DOMContentLoaded', function () {
    const heroTitle   = document.querySelector('.pv-hero-title');
    const heroTagline = document.querySelector('.pv-hero-tagline');
    if (!heroTitle || !heroTagline) return;

    const teksAsli = {
        title:   heroTitle.textContent.trim(),
        tagline: heroTagline.textContent.trim(),
    };

    const namaSekolah = document.querySelector('.pv-hero-pill-brand-text .name')
        ? document.querySelector('.pv-hero-pill-brand-text .name').textContent.trim()
        : teksAsli.title;

    const sambutanHalaman = {
        beranda:          { title: teksAsli.title,                     tagline: teksAsli.tagline },
        profil:           { title: 'Selamat Datang di Profil Sekolah', tagline: namaSekolah },
        artikel:          { title: 'Selamat Datang di Artikel',        tagline: namaSekolah },
        pasilitas:        { title: 'Selamat Datang di Fasilitas',      tagline: namaSekolah },
        guru:             { title: 'Selamat Datang di Guru & Staff',   tagline: namaSekolah },
        ekstrakurikuler:  { title: 'Selamat Datang di Ekstrakurikuler',tagline: namaSekolah },
        kontak:           { title: 'Selamat Datang di Kontak',         tagline: namaSekolah },
    };

    let currentPage = 'beranda';

    function restartAnimasi(el) {
        el.style.animation = 'none';
        void el.offsetWidth;
        el.style.animation = '';
    }

    function gantiTeksHero(page) {
        const data = sambutanHalaman[page];
        if (!data || page === currentPage) return;
        currentPage = page;

        heroTitle.textContent   = data.title;
        heroTagline.textContent = data.tagline;

        restartAnimasi(heroTitle);
        restartAnimasi(heroTagline);
    }

    document.querySelectorAll('.menu-item[data-page]').forEach(function (link) {
        if (link.classList.contains('dropdown-toggle')) return;
        link.addEventListener('click', function () {
            gantiTeksHero(link.dataset.page);
        });
    });
});