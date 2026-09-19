<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrestasiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'judul.required' => 'Judul prestasi wajib diisi.',
            'gambar.image'   => 'File gambar harus berupa gambar.',
            'gambar.mimes'   => 'Format gambar harus jpg, jpeg, png, atau webp.',
            'gambar.max'     => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}