<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UpdatePocketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check() && Auth::id() === $this->route('pocket')->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $pocket = $this->route('pocket');

        return [
            'nama' => [
                'required',
                'string',
                'max:255',
                Rule::unique('pockets')
                    ->where('user_id', Auth::id())
                    ->ignore($pocket->id),
            ],
            'warna' => [
                'required',
                'string',
                'regex:/^#([A-Fa-f0-9]{6})$/',
            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nama.required' => 'Nama pocket wajib diisi.',
            'nama.string' => 'Nama pocket harus berupa teks.',
            'nama.max' => 'Nama pocket maksimal 255 karakter.',
            'nama.unique' => 'Nama pocket sudah digunakan. Gunakan nama yang berbeda.',
            'warna.required' => 'Warna wajib dipilih.',
            'warna.regex' => 'Format warna tidak valid.',
        ];
    }
}

