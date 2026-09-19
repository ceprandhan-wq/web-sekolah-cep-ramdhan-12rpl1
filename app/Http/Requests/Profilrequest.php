<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfilRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_sekolah'   => 'required|string|max:255',
            'moto'           => 'nullable|string|max:255',
            'npsn'           => 'nullable|string|max:20',
            'telepon'        => 'nullable|string|max:20',
            'alamat'         => 'nullable|string|max:500',
            'email'          => 'nullable|email|max:255',
            'website'        => 'nullable|url|max:255',
            'sejarah'        => 'nullable|string',
            'visi'           => 'nullable|string',
            'misi'           => 'nullable|string',
            'deskripsi'      => 'nullable|string',
            'logo'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'foto_hero'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'foto_sambutan'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_sekolah.required' => 'Nama sekolah wajib diisi.',
            'email.email'           => 'Format email tidak valid.',
            'website.url'           => 'Format website tidak valid.',
            'logo.image'            => 'File logo harus berupa gambar.',
            'logo.mimes'            => 'Format logo harus jpg, jpeg, png, atau webp.',
            'foto_hero.image'       => 'File foto hero harus berupa gambar.',
            'foto_sambutan.image'   => 'File foto sambutan harus berupa gambar.',
        ];
    }
}