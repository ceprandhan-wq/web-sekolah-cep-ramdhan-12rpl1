<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\Jurusan;
use Illuminate\Database\Seeder;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        // PENTING: seeder Laravel secara default hanya MENAMBAH baris baru,
        // tidak menghapus data lama. Supaya data guru lama (mis. "Staf TU",
        // "Wira", entri dengan foto placeholder) tidak menumpuk bersamaan
        // dengan data baru di bawah, tabel guru dikosongkan dulu di sini.
        Guru::query()->delete();

        // ==========================================================
        // Ambil id tiap jurusan (dipakai untuk mengisi 'jurusan_id' pada
        // guru yang mapel/jabatannya terkait jurusan tertentu).
        //
        // FIX: sebelumnya jurusan TKR dicari dengan
        // where('nama_jurusan', 'like', '%Otomotif%'), padahal nama
        // jurusan di JurusanSeeder adalah 'Teknik Kendaraan Ringan' —
        // tidak mengandung kata "Otomotif" sama sekali. Akibatnya
        // $jurusanOtomotif selalu null dan seluruh guru TKR di bawah
        // tidak pernah ter-assign ke jurusan manapun di database.
        // Sekarang dicari berdasarkan 'kode' (konsisten dengan
        // JurusanSeeder: 'tkr', 'aphp', 'pplg', 'pms').
        // ==========================================================
        $jurusanTkr       = Jurusan::where('kode', 'tkr')->first()?->id;
        $jurusanAphp      = Jurusan::where('kode', 'aphp')->first()?->id;
        $jurusanPplg      = Jurusan::where('kode', 'pplg')->first()?->id;
        $jurusanPemasaran = Jurusan::where('kode', 'pms')->first()?->id;

        // ==========================================================
        // Data guru & staf — DIROMBAK TOTAL dari foto profil resmi yang
        // diunggah admin (nama, mapel/jabatan, foto sesuai file di
        // public/images/guru-guru/). Entri lama tanpa foto yang cocok
        // (Bani, Budi, Ende, Staf TU, Wira, Guru PKN) DIHAPUS sesuai
        // instruksi.
        //
        // CATATAN: dua kartu foto memakai nama yang sama persis
        // "Rina Susana, S.Pd." padahal orangnya berbeda (satu guru
        // Bahasa Inggris, satu guru PPLG berpeci) — kemungkinan salah
        // ketik nama di salah satu kartu. Entri kedua diberi tanda
        // '(PPLG)' sementara sampai nama aslinya dikonfirmasi ulang.
        //
        // STRUKTUR FILE INI: data dikelompokkan per jurusan (Teknik
        // Kendaraan Ringan, APHP, PPLG, Pemasaran) — guru produktif.
        // Guru mapel umum/adaptif dan staf yang tidak terikat jurusan
        // tertentu diletakkan di bagian paling bawah.
        // ==========================================================

        // ---------------- Kepala Sekolah ----------------

        Guru::create([
            'nama'       => 'A Rahmat Dimyati, S.Pd., M.Pd.',
            'nip'        => '-',
            'mapel'      => null,
            'jurusan_id' => null,
            'staf'       => true,
            'jabatan'    => 'Kepala Sekolah',
            'foto'       => 'a_rahmat_dimyati.jpeg',
        ]);

        // ==========================================================
        // JURUSAN: TEKNIK KENDARAAN RINGAN (TKR) — GURU PRODUKTIF
        // ==========================================================

        Guru::create([
            'nama'       => 'Andri Muhoir, S.T.',
            'nip'        => '-',
            'mapel'      => 'Teknik Otomotif',
            'jurusan_id' => $jurusanTkr,
            'staf'       => false,
            'jabatan'    => '-',
            'foto'       => 'andri_muhoir.jpg',
        ]);

        Guru::create([
            'nama'       => 'Asep Purnama',
            'nip'        => '-',
            'mapel'      => null,
            'jurusan_id' => $jurusanTkr,
            'staf'       => true,
            'jabatan'    => 'Laboran Teknik Otomotif',
            'foto'       => 'asep_purnama.jpg',
        ]);

        Guru::create([
            'nama'       => 'Jajang Ridwan, S.T.',
            'nip'        => '-',
            'mapel'      => 'Teknik Otomotif',
            'jurusan_id' => $jurusanTkr,
            'staf'       => false,
            'jabatan'    => '-',
            'foto'       => 'jajang_ridwan.jpg',
        ]);

        Guru::create([
            'nama'       => 'Romi Darmayadi, S.Pd., S.T.',
            'nip'        => '-',
            'mapel'      => 'Teknik Otomotif',
            'jurusan_id' => $jurusanTkr,
            'staf'       => false,
            'jabatan'    => '-',
            'foto'       => 'romi_darmayadi.jpg',
        ]);

        // ==========================================================
        // JURUSAN: APHP (Agriteknologi Pengolahan Hasil Pertanian)
        // GURU PRODUKTIF
        // ==========================================================

        Guru::create([
            'nama'       => 'Budiana Hermawan, S.TP.',
            'nip'        => '-',
            'mapel'      => 'APHP',
            'jurusan_id' => $jurusanAphp,
            'staf'       => false,
            'jabatan'    => '-',
            'foto'       => 'budiana_hermawan.jpg',
        ]);

        Guru::create([
            'nama'       => 'Ende Iskandar, S.TP.',
            'nip'        => '-',
            'mapel'      => 'APHP',
            'jurusan_id' => $jurusanAphp,
            'staf'       => false,
            'jabatan'    => '-',
            'foto'       => 'ende_iskandar.jpg',
        ]);

        Guru::create([
            'nama'       => 'Saripul Basar',
            'nip'        => '-',
            'mapel'      => null,
            'jurusan_id' => $jurusanAphp,
            'staf'       => true,
            'jabatan'    => 'Laboran APHP',
            'foto'       => 'saripul_basar.jpg',
        ]);

        // ==========================================================
        // JURUSAN: PPLG (Pengembangan Perangkat Lunak dan Gim)
        // GURU PRODUKTIF
        // ==========================================================

        Guru::create([
            'nama'       => 'Didi Mei Somatri, S.Kom.',
            'nip'        => '-',
            'mapel'      => 'PPLG',
            'jurusan_id' => $jurusanPplg,
            'staf'       => false,
            'jabatan'    => '-',
            'foto'       => 'didi_mei_somatri.jpg',
        ]);

        Guru::create([
            'nama'       => 'Moch Najib',
            'nip'        => '-',
            'mapel'      => null,
            'jurusan_id' => $jurusanPplg,
            'staf'       => true,
            'jabatan'    => 'Laboran PPLG',
            'foto'       => 'moch_najib__1_.jpg',
        ]);

        Guru::create([
            'nama'       => 'Rahmat Setiawan, S.T.',
            'nip'        => '-',
            'mapel'      => 'PPLG',
            'jurusan_id' => $jurusanPplg,
            'staf'       => false,
            'jabatan'    => '-',
            'foto'       => 'rahmat_setiawan.jpg',
        ]);

        // TODO: nama sementara "(PPLG)" ditambahkan karena kartu foto ini
        // memakai nama yang sama persis dengan salah satu guru Bahasa
        // Inggris ("Rina Susana, S.Pd.") padahal orangnya jelas berbeda
        // (pria, bukan wanita). Ganti 'nama' di bawah ini dengan nama yang
        // benar begitu dikonfirmasi.
        Guru::create([
            'nama'       => 'Bani Pudoli, S.ST',
            'nip'        => '-',
            'mapel'      => 'PPLG',
            'jurusan_id' => $jurusanPplg,
            'staf'       => false,
            'jabatan'    => '-',
            'foto'       => 'bani pudoli S.ST..jpeg',
        ]);

        Guru::create([
            'nama'       => 'Silvi Danu Respita, S.T.',
            'nip'        => '-',
            'mapel'      => 'PPLG',
            'jurusan_id' => $jurusanPplg,
            'staf'       => false,
            'jabatan'    => '-',
            'foto'       => 'silvi_danu_respita.jpg',
        ]);

        Guru::create([
            'nama'       => 'Wahyudin, S.Tr.Kom.',
            'nip'        => '-',
            'mapel'      => 'PPLG',
            'jurusan_id' => $jurusanPplg,
            'staf'       => false,
            'jabatan'    => '-',
            'foto'       => 'wahyudin.jpg',
        ]);

        // ==========================================================
        // JURUSAN: BISNIS DARING DAN PEMASARAN — GURU PRODUKTIF
        // ==========================================================

        Guru::create([
            'nama'       => 'Dini Andriani, S.E.',
            'nip'        => '-',
            'mapel'      => 'Pemasaran',
            'jurusan_id' => $jurusanPemasaran,
            'staf'       => false,
            'jabatan'    => '-',
            'foto'       => 'dini_andriani.jpg',
        ]);

        Guru::create([
            'nama'       => 'Eli Maryamah, S.Pd.',
            'nip'        => '-',
            'mapel'      => 'Pemasaran',
            'jurusan_id' => $jurusanPemasaran,
            'staf'       => false,
            'jabatan'    => '-',
            'foto'       => 'eli_maryamah.jpg',
        ]);

        Guru::create([
            'nama'       => 'Indra Murgianto, S.Pd.',
            'nip'        => '-',
            'mapel'      => 'Pemasaran',
            'jurusan_id' => $jurusanPemasaran,
            'staf'       => false,
            'jabatan'    => '-',
            'foto'       => 'indra_murgianto.jpg',
        ]);

        Guru::create([
            'nama'       => 'Kamalia, S.E.',
            'nip'        => '-',
            'mapel'      => 'Pemasaran',
            'jurusan_id' => $jurusanPemasaran,
            'staf'       => false,
            'jabatan'    => '-',
            'foto'       => 'kamalia.jpg',
        ]);

        Guru::create([
            'nama'       => 'Nanang Suryana, S.E., M.M.',
            'nip'        => '-',
            'mapel'      => 'Pemasaran',
            'jurusan_id' => $jurusanPemasaran,
            'staf'       => false,
            'jabatan'    => '-',
            'foto'       => 'nanang_suryana.jpg',
        ]);

        Guru::create([
            'nama'       => 'Santi Mustika',
            'nip'        => '-',
            'mapel'      => null,
            'jurusan_id' => $jurusanPemasaran,
            'staf'       => true,
            'jabatan'    => 'Laboran Pemasaran',
            'foto'       => 'santi_mustika.jpg',
        ]);

        Guru::create([
            'nama'       => 'Setiawan, S.E.',
            'nip'        => '-',
            'mapel'      => 'Pemasaran',
            'jurusan_id' => $jurusanPemasaran,
            'staf'       => false,
            'jabatan'    => '-',
            'foto'       => 'setiawan.jpg',
        ]);

        // ==========================================================
        // GURU MAPEL UMUM / ADAPTIF & STAF TANPA JURUSAN
        // (tidak terikat ke satu jurusan tertentu — diletakkan paling
        // bawah sesuai permintaan)
        // ==========================================================

        Guru::create([
            'nama'       => 'Ahmad Suhendra',
            'nip'        => '-',
            'mapel'      => null,
            'jurusan_id' => null,
            'staf'       => true,
            'jabatan'    => 'Kebersihan & Keindahan Sekolah',
            'foto'       => 'Ahmad_Suhendra.jpg',
        ]);

        Guru::create([
            'nama'       => 'Ai Nurhasanah, S.Pd.',
            'nip'        => '-',
            'mapel'      => 'Matematika & Informatika',
            'jurusan_id' => null,
            'staf'       => false,
            'jabatan'    => '-',
            'foto'       => 'ai_nurhasanah.jpg',
        ]);

        Guru::create([
            'nama'       => 'Apendi',
            'nip'        => '-',
            'mapel'      => null,
            'jurusan_id' => null,
            'staf'       => true,
            'jabatan'    => 'Kebersihan & Keindahan Sekolah',
            'foto'       => 'apendi.jpg',
        ]);

        Guru::create([
            'nama'       => 'Asep Muhlis Sulaeman, S.Pd.I.',
            'nip'        => '-',
            'mapel'      => 'PAI & BP',
            'jurusan_id' => null,
            'staf'       => false,
            'jabatan'    => '-',
            'foto'       => 'asep_muhlis_sulaeman.jpg',
        ]);

        Guru::create([
            'nama'       => 'Ayi Suryati, A.Ma.Pust.',
            'nip'        => '-',
            'mapel'      => null,
            'jurusan_id' => null,
            'staf'       => true,
            'jabatan'    => 'Administrasi Perpustakaan',
            'foto'       => 'ayi_suryati.jpg',
        ]);

        Guru::create([
            'nama'       => 'D Jamaludin',
            'nip'        => '-',
            'mapel'      => null,
            'jurusan_id' => null,
            'staf'       => true,
            'jabatan'    => 'Kebersihan & Keindahan Sekolah',
            'foto'       => 'd_jamaludin.jpg',
        ]);

        Guru::create([
            'nama'       => 'Dedi Sukardi, S.Pd.',
            'nip'        => '-',
            'mapel'      => 'PJOK',
            'jurusan_id' => null,
            'staf'       => false,
            'jabatan'    => '-',
            'foto'       => 'Dedi_Sukardi.jpg',
        ]);

        Guru::create([
            'nama'       => 'Edeh Kurniasih, S.Pd.',
            'nip'        => '-',
            'mapel'      => 'Bahasa Indonesia',
            'jurusan_id' => null,
            'staf'       => false,
            'jabatan'    => '-',
            'foto'       => 'edeh_kurniasih.jpg',
        ]);

        Guru::create([
            'nama'       => 'Ela Haryati, S.Pd.',
            'nip'        => '-',
            'mapel'      => 'Pendidikan Pancasila & PKK',
            'jurusan_id' => null,
            'staf'       => false,
            'jabatan'    => '-',
            'foto'       => 'ela_haryati.jpg',
        ]);

        Guru::create([
            'nama'       => 'Emi Resmiyati, S.Pd.',
            'nip'        => '-',
            'mapel'      => 'Projek Ilmu Pengetahuan Alam dan Sosial',
            'jurusan_id' => null,
            'staf'       => false,
            'jabatan'    => '-',
            'foto'       => 'emi_resmiyati.jpg',
        ]);

        Guru::create([
            'nama'       => 'Habib Suhandar, S.Pd.',
            'nip'        => '-',
            'mapel'      => 'Pendidikan Pancasila & Sejarah',
            'jurusan_id' => null,
            'staf'       => false,
            'jabatan'    => '-',
            'foto'       => 'Habib_Suhandar.jpg',
        ]);

        Guru::create([
            'nama'       => 'Indra Priatna, S.Pd.',
            'nip'        => '-',
            'mapel'      => 'Pendidikan Pancasila & Informatika',
            'jurusan_id' => null,
            'staf'       => false,
            'jabatan'    => '-',
            'foto'       => 'indra_priatna.jpg',
        ]);

        Guru::create([
            'nama'       => 'Isnan Wiranursyeha, S.Pd.',
            'nip'        => '-',
            'mapel'      => 'Bahasa Indonesia',
            'jurusan_id' => null,
            'staf'       => false,
            'jabatan'    => '-',
            'foto'       => 'isnan_wiranursyeha.jpg',
        ]);

        Guru::create([
            'nama'       => 'Jaya Nur Setiawandi, S.Pd.',
            'nip'        => '-',
            'mapel'      => 'PJOK & Bahasa Sunda',
            'jurusan_id' => null,
            'staf'       => false,
            'jabatan'    => '-',
            'foto'       => 'jaya_nur_setiawandi.jpg',
        ]);

        Guru::create([
            'nama'       => 'Mega Nurunnisa, S.Pd.',
            'nip'        => '-',
            'mapel'      => 'Bahasa Indonesia & Seni Budaya',
            'jurusan_id' => null,
            'staf'       => false,
            'jabatan'    => '-',
            'foto'       => 'Mega_Nurunnisa.jpg',
        ]);

        Guru::create([
            'nama'       => 'Mia Rusmiati, S.Pd.',
            'nip'        => '-',
            'mapel'      => 'Matematika & Bahasa Inggris',
            'jurusan_id' => null,
            'staf'       => false,
            'jabatan'    => '-',
            'foto'       => 'mia_rusmiati.jpg',
        ]);

        Guru::create([
            'nama'       => 'Moch. Yoga Agung N., S.Pd., M.Pd.',
            'nip'        => '-',
            'mapel'      => 'Bahasa Sunda',
            'jurusan_id' => null,
            'staf'       => false,
            'jabatan'    => '-',
            'foto'       => 'moch_yoga_agung.jpg',
        ]);

        Guru::create([
            'nama'       => 'Muldiansah',
            'nip'        => '-',
            'mapel'      => null,
            'jurusan_id' => null,
            'staf'       => true,
            'jabatan'    => 'Keamanan & Ketertiban Sekolah',
            'foto'       => 'muldiansah.jpg',
        ]);

        Guru::create([
            'nama'       => 'Nopi Yanti, S.Pd.',
            'nip'        => '-',
            'mapel'      => 'Pendidikan Pancasila & Sejarah',
            'jurusan_id' => null,
            'staf'       => false,
            'jabatan'    => '-',
            'foto'       => 'nopi_yanti.jpg',
        ]);

        Guru::create([
            'nama'       => 'Nuraeni, S.Pd.',
            'nip'        => '-',
            'mapel'      => 'Matematika',
            'jurusan_id' => null,
            'staf'       => false,
            'jabatan'    => '-',
            'foto'       => 'nuraeni.jpg',
        ]);

        Guru::create([
            'nama'       => 'Nurah Alwaini, A.Ma.Pust.',
            'nip'        => '-',
            'mapel'      => null,
            'jurusan_id' => null,
            'staf'       => true,
            'jabatan'    => 'Administrasi Perpustakaan',
            'foto'       => 'nurah_alwaini.jpg',
        ]);

        Guru::create([
            'nama'       => 'Nurdiansah, S.IP.',
            'nip'        => '-',
            'mapel'      => null,
            'jurusan_id' => null,
            'staf'       => true,
            'jabatan'    => 'Adm Persuratan, Kesiswaan & Kurikulum',
            'foto'       => 'nurdiansah.jpg',
        ]);

        Guru::create([
            'nama'       => 'Ramdan Bastaman',
            'nip'        => '-',
            'mapel'      => null,
            'jurusan_id' => null,
            'staf'       => true,
            'jabatan'    => 'Administrasi Sarpras',
            'foto'       => 'Ramdan_Bastaman.jpg',
        ]);

        Guru::create([
            'nama'       => 'Rina Susana, S.Pd.',
            'nip'        => '-',
            'mapel'      => 'Bahasa Inggris',
            'jurusan_id' => null,
            'staf'       => false,
            'jabatan'    => '-',
            'foto'       => 'rina_susana.jpg',
        ]);

        Guru::create([
            'nama'       => 'Sakti Alamsyah, S.E.',
            'nip'        => '-',
            'mapel'      => null,
            'jurusan_id' => null,
            'staf'       => true,
            'jabatan'    => 'Administrasi Sarpras',
            'foto'       => 'Sakti_Alamsyah.jpg',
        ]);

        Guru::create([
            'nama'       => 'Sima Kristina, S.Kom.',
            'nip'        => '-',
            'mapel'      => null,
            'jurusan_id' => null,
            'staf'       => true,
            'jabatan'    => 'Administrasi Keuangan dan Publikasi',
            'foto'       => 'sima_kristina.jpg',
        ]);

        Guru::create([
            'nama'       => 'Siti Rahmawati, S.Pd.I.',
            'nip'        => '-',
            'mapel'      => 'PAI & BP',
            'jurusan_id' => null,
            'staf'       => false,
            'jabatan'    => '-',
            'foto'       => 'siti_rahmawati.jpg',
        ]);

        Guru::create([
            'nama'       => 'Tatang Rustandi',
            'nip'        => '-',
            'mapel'      => null,
            'jurusan_id' => null,
            'staf'       => true,
            'jabatan'    => 'Kebersihan & Keindahan Sekolah',
            'foto'       => 'tatang_rustandi.jpg',
        ]);

        Guru::create([
            'nama'       => 'Yani Cahyani, S.Pd.',
            'nip'        => '-',
            'mapel'      => 'Bahasa Inggris',
            'jurusan_id' => null,
            'staf'       => false,
            'jabatan'    => '-',
            'foto'       => 'yani_cahyani.jpg',
        ]);

        Guru::create([
            'nama'       => 'Yayup Hindriyani, S.Pd.',
            'nip'        => '-',
            'mapel'      => 'Matematika & Informatika',
            'jurusan_id' => null,
            'staf'       => false,
            'jabatan'    => '-',
            'foto'       => 'yayup_hindriyani.jpg',
        ]);

        Guru::create([
            'nama'       => 'Yogi Saputra',
            'nip'        => '-',
            'mapel'      => null,
            'jurusan_id' => null,
            'staf'       => true,
            'jabatan'    => 'Keamanan & Ketertiban Sekolah',
            'foto'       => 'yogi_saputra.jpg',
        ]);
    }
}