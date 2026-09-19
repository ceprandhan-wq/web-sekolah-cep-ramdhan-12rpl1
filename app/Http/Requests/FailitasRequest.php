<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FasilitasRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_fasilitas' => 'required|string|max:255',
            'deskripsi'      => 'nullable|string',
            'gambar'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_fasilitas.required' => 'Nama fasilitas wajib diisi.',
            'gambar.image'            => 'File gambar harus berupa gambar.',
            'gambar.mimes'            => 'Format gambar harus jpg, jpeg, png, atau webp.',
            'gambar.max'              => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}