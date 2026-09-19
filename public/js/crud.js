// ==========================
// CRUD generik: dipakai di semua halaman kelola data
// (Jurusan, Guru, Ekstrakurikuler, Galeri, Berita, Agenda)
// ==========================
document.addEventListener('DOMContentLoaded', function () {
    const dialogAdd = document.getElementById('dialogAdd');
    const dialogEdit = document.getElementById('dialogEdit');
    const btnAdd = document.getElementById('btnAdd');
    const formEdit = document.getElementById('formEdit');

    // ---- Buka dialog Tambah ----
    if (btnAdd && dialogAdd) {
        btnAdd.addEventListener('click', () => dialogAdd.showModal());
    }

    // ---- Tutup dialog (tombol Batal / klik di luar) ----
    document.querySelectorAll('.crud-dialog [data-close]').forEach(btn => {
        btn.addEventListener('click', () => btn.closest('dialog').close());
    });
    document.querySelectorAll('.crud-dialog').forEach(dialog => {
        dialog.addEventListener('click', function (e) {
            const rect = dialog.querySelector('form').getBoundingClientRect();
            const clickedOutsideForm =
                e.clientX < rect.left || e.clientX > rect.right ||
                e.clientY < rect.top || e.clientY > rect.bottom;
            if (clickedOutsideForm) dialog.close();
        });
    });

    // ---- Buka dialog Edit + isi otomatis dari tombol yang diklik ----
    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', function () {
            if (!dialogEdit || !formEdit) return;

            // Set action form sesuai id data yang diklik
            const actionTemplate = formEdit.dataset.actionTemplate;
            const id = btn.dataset.id;
            if (actionTemplate && id) {
                formEdit.action = actionTemplate.replace(':id', id);
            }

            // Isi tiap input di form Edit dari atribut data-* tombol
            formEdit.querySelectorAll('[data-field]').forEach(input => {
                const field = input.dataset.field;
                const attrName = 'data-' + field.replace(/_/g, '-');
                const value = btn.getAttribute(attrName);
                if (value !== null) {
                    input.value = value;
                }
            });

            dialogEdit.showModal();
        });
    });
});