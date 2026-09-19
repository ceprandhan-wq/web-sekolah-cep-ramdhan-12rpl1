<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GaleriVideoRequest;
use App\Models\GaleriVideo;
use Illuminate\Support\Facades\Storage;

class GaleriVideoController extends Controller
{
    public function store(GaleriVideoRequest $request)
    {
        $data = $request->safe()->except('thumbnail');

        if ($request->hasFile('thumbnail')) {
            $filename = $request->file('thumbnail')->hashName();
            $request->file('thumbnail')->storeAs('images/video', $filename, 'public');
            $data['thumbnail'] = $filename;
        } elseif (!empty($data['youtube_id'])) {
            $data['thumbnail'] = "https://img.youtube.com/vi/{$data['youtube_id']}/hqdefault.jpg";
        }

        GaleriVideo::create($data);

        return back()->with('success', 'Video berhasil ditambahkan.');
    }

    public function update(GaleriVideoRequest $request, GaleriVideo $galeri_video)
    {
        $galeri_video->fill($request->safe()->except('thumbnail'));

        if ($request->hasFile('thumbnail')) {
            if ($galeri_video->thumbnail && !Star::startsWith($galeri_video->thumbnail, 'http')) {
                Storage::disk('public')->delete('images/video/'.$galeri_video->thumbnail);
            }
            $filename = $request->file('thumbnail')->hashName();
            $request->file('thumbnail')->storeAs('images/video', $filename, 'public');
            $galeri_video->thumbnail = $filename;
        } elseif ($request->youtube_id && !$galeri_video->thumbnail) {
            $galeri_video->thumbnail = "https://img.youtube.com/vi/{$request->youtube_id}/hqdefault.jpg";
        }

        $galeri_video->save();

        return back()->with('success', 'Video berhasil diperbarui.');
    }

    public function destroy(GaleriVideo $galeri_video)
    {
        if ($galeri_video->thumbnail && !str_starts_with($galeri_video->thumbnail, 'http')) {
            Storage::disk('public')->delete('images/video/'.$galeri_video->thumbnail);
        }

        $galeri_video->delete();
        return back()->with('success', 'Video berhasil dihapus.');
    }
}