<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KepalaSekolahRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kepsek_nama'    => ['required', 'string', 'max:150'],
            'kepsek_jabatan' => ['required', 'string', 'max:100'],
            'kepsek_foto'    => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'sambutan'       => ['required', 'string', 'min:20'],
        ];
    }

    public function messages(): array
    {
        return [
            'kepsek_nama.required'    => 'Nama Kepala Sekolah wajib diisi.',
            'kepsek_jabatan.required' => 'Jabatan wajib diisi.',
            'sambutan.required'       => 'Isi sambutan wajib diisi.',
            'sambutan.min'            => 'Isi sambutan terlalu pendek, minimal 20 karakter.',
            'kepsek_foto.image'       => 'File foto harus berupa gambar.',
            'kepsek_foto.mimes'       => 'Format foto harus jpg, jpeg, png, atau webp.',
            'kepsek_foto.max'         => 'Ukuran foto maksimal 2MB.',
        ];
    }
}