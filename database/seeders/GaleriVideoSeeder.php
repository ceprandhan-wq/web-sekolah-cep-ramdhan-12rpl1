<?php

namespace Database\Seeders;

use App\Models\GaleriVideo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class GaleriVideoSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['judul' => 'Kegiatan Sekolah 1', 'youtube_id' => 'tnDxcQfZO4c', 'urutan' => 1],
            ['judul' => 'Kegiatan Sekolah 2', 'youtube_id' => '597Cegi_KZ0', 'urutan' => 2],
            ['judul' => 'Kegiatan Sekolah 3', 'youtube_id' => 'AbIKoCH5MKw', 'urutan' => 3],
            ['judul' => 'Kegiatan Sekolah 4', 'youtube_id' => 'MV-9TM7J7mQ', 'urutan' => 4],
            ['judul' => 'Kegiatan Sekolah 5', 'youtube_id' => '06UqP1h48m4', 'urutan' => 5],
            ['judul' => 'Kegiatan Sekolah 6', 'youtube_id' => '9zLPpbjngew', 'urutan' => 6],
        ];

        // Folder tujuan: storage/app/public/images/video (diakses browser lewat
        // symlink public/storage -> storage/app/public, jadi pastikan sudah
        // menjalankan `php artisan storage:link`).
        $diskPath = 'images/video';

        foreach ($data as $row) {
            $filename = $row['youtube_id'] . '.jpg';
            $storagePath = $diskPath . '/' . $filename;

            // Hanya download kalau file belum ada, biar seeder bisa dijalankan berkali-kali
            // tanpa boros bandwidth / request ke YouTube tiap kali.
            if (! Storage::disk('public')->exists($storagePath)) {
                $url = "https://img.youtube.com/vi/{$row['youtube_id']}/hqdefault.jpg";

                try {
                    $response = Http::timeout(10)->get($url);

                    if ($response->ok()) {
                        Storage::disk('public')->put($storagePath, $response->body());
                    } else {
                        $this->command?->warn("Gagal ambil thumbnail untuk {$row['judul']} (HTTP {$response->status()})");
                    }
                } catch (\Throwable $e) {
                    $this->command?->warn("Gagal ambil thumbnail untuk {$row['judul']}: {$e->getMessage()}");
                }
            }

            // Simpan NAMA FILE saja ke kolom thumbnail, bukan URL penuh —
            // ini yang dibaca oleh asset('storage/images/video/'.$item->thumbnail) di admin panel.
            $row['thumbnail'] = Storage::disk('public')->exists($storagePath) ? $filename : null;

            GaleriVideo::updateOrCreate(['judul' => $row['judul']], $row);
        }
    }
}