<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KontakRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'alamat'          => 'nullable|string|max:500',
            'telepon'         => 'nullable|string|max:30',
            'whatsapp'        => 'nullable|string|max:30',
            'email'           => 'nullable|email|max:255',
            'website'         => 'nullable|string|max:255',
            'jam_operasional' => 'nullable|string|max:255',
            'maps_embed'      => 'nullable|url|max:2000',
            'facebook'        => 'nullable|url|max:255',
            'instagram'       => 'nullable|url|max:255',
            'youtube'         => 'nullable|url|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'email.email'      => 'Format email tidak valid.',
            'maps_embed.url'   => 'Isi dengan URL src dari embed Google Maps.',
            'facebook.url'     => 'Format link Facebook tidak valid.',
            'instagram.url'    => 'Format link Instagram tidak valid.',
            'youtube.url'      => 'Format link YouTube tidak valid.',
        ];
    }
}