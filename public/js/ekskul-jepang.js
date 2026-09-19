document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('.ekskul-detail-page')?.classList.add('is-visible');

    var tc = document.getElementById('ekskulTimecode');
    if (!tc) return;

    var prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReducedMotion) return;

    // Timecode kamera standar sinema: 24 frame per detik
    var fps = 24;
    var frames = 0;

    setInterval(function () {
        frames++;
        var totalSeconds = Math.floor(frames / fps);
        var h = Math.floor(totalSeconds / 3600);
        var m = Math.floor((totalSeconds % 3600) / 60);
        var s = totalSeconds % 60;
        var f = frames % fps;
        var pad = function (n) { return String(n).padStart(2, '0'); };
        tc.textContent = pad(h) + ':' + pad(m) + ':' + pad(s) + ':' + pad(f);
    }, 1000 / fps);
});