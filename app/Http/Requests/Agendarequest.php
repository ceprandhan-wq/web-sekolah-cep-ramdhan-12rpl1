<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgendaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul'      => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'tanggal'    => 'required|date',
        ];
    }

    public function messages(): array
    {
        return [
            'judul.required'   => 'Judul agenda wajib diisi.',
            'tanggal.required' => 'Tanggal agenda wajib diisi.',
            'tanggal.date'     => 'Format tanggal tidak valid.',
        ];
    }
}