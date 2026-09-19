<?php
// app/Models/GaleriVideo.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaleriVideo extends Model
{
    protected $table = 'galeri_videos';
    protected $fillable = ['judul', 'thumbnail', 'youtube_id', 'url', 'urutan'];
}