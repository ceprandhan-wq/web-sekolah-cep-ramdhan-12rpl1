<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GaleriVideoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul'      => 'required|string|max:255',
            'youtube_id' => 'nullable|string|max:50',
            'url'        => 'nullable|url|max:255',
            'thumbnail'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'judul.required'   => 'Judul video wajib diisi.',
            'url.url'          => 'Format URL tidak valid.',
            'thumbnail.image'  => 'File thumbnail harus berupa gambar.',
            'thumbnail.mimes'  => 'Format thumbnail harus jpg, jpeg, png, atau webp.',
        ];
    }
}