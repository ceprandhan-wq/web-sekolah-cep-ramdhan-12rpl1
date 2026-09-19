<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class JurusanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $jurusanId = $this->route('jurusan')?->id;

        return [
            'kode'           => [
                'required', 'string', 'max:10', 'alpha_dash',
                Rule::unique('jurusans', 'kode')->ignore($jurusanId),
            ],
            'nama_jurusan'   => [
                'required', 'string', 'max:150',
                Rule::unique('jurusans', 'nama_jurusan')->ignore($jurusanId),
            ],
            'kepala_jurusan' => ['required', 'string', 'max:150'],
            'deskripsi'      => ['nullable', 'string', 'max:2000'],
            'foto_kepala_jurusan' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'logo_jurusan'   => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'foto'           => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:4096'],
        ];
    }

    public function messages(): array
    {
        return [
            'kode.unique' => 'Kode jurusan ini sudah dipakai.',
            'nama_jurusan.unique' => 'Nama jurusan ini sudah terdaftar di database.',
            'foto_kepala_jurusan.image' => 'Foto kepala jurusan harus berupa gambar (jpg/jpeg/png).',
        ];
    }
}