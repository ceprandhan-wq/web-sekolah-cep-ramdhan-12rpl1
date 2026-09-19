<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuruRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama'       => 'required|string|max:255',
            'nip'        => 'nullable|string|max:50',
            'staf'       => 'nullable|boolean',
            'mapel'      => 'nullable|string|max:255',
            'jabatan'    => 'nullable|string|max:255',
            'jurusan_id' => 'nullable|exists:jurusan,id',
            'foto'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required'       => 'Nama guru/staf wajib diisi.',
            'jurusan_id.exists'   => 'Jurusan yang dipilih tidak valid.',
            'foto.image'          => 'File foto harus berupa gambar.',
            'foto.mimes'          => 'Format foto harus jpg, jpeg, png, atau webp.',
            'foto.max'            => 'Ukuran foto maksimal 2MB.',
        ];
    }
}