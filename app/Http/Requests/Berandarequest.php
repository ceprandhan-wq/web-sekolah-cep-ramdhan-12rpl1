<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BerandaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul'          => 'nullable|string|max:255',
            'deskripsi'      => 'nullable|string',
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'kepsek_nama'    => 'nullable|string|max:255',
            'kepsek_jabatan' => 'nullable|string|max:255',
            'kepsek_foto'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sambutan'       => 'nullable|string',

            'jumlah_siswa'   => 'nullable|integer|min:0',
            'jumlah_guru'    => 'nullable|integer|min:0',
        ];
    }
}