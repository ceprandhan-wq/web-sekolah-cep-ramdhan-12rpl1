<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EkstrakurikulerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama'             => 'required|string|max:255',
            'id_pembina'       => 'nullable|exists:guru,id',
            'deskripsi'        => 'nullable|string',
            'jadwal'           => 'nullable|string|max:255',
            'lokasi'           => 'nullable|string|max:255',
            'status'           => 'nullable|string|in:aktif,nonaktif|max:50',
            'foto'             => 'nullable|image|max:2048',
            'logo'             => 'nullable|image|max:2048',
            'dokumentasi'      => 'nullable|array',
            'dokumentasi.*'    => 'nullable|image|max:2048',
            'kegiatan_rutin'   => 'nullable|array',
            'kegiatan_rutin.*' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required'       => 'Nama ekstrakurikuler wajib diisi.',
            'id_pembina.exists'   => 'Pembina yang dipilih tidak valid.',
            'status.in'           => 'Status harus aktif atau nonaktif.',
            'dokumentasi.*.image' => 'Setiap dokumentasi harus berupa gambar.',
        ];
    }
}