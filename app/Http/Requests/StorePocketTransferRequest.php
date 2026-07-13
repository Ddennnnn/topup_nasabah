<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePocketTransferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'from_pocket' => [
                'nullable',
                'exists:pockets,id',
                function ($attribute, $value, $fail) {
                    // Check if from_pocket belongs to authenticated user
                    if ($value !== null) {
                        $pocket = \App\Models\Pocket::where('id', $value)
                            ->where('user_id', Auth::id())
                            ->first();
                        if (!$pocket) {
                            $fail('Pocket asal tidak valid.');
                        }
                    }
                },
            ],
            'to_pocket' => [
                'nullable',
                'exists:pockets,id',
                function ($attribute, $value, $fail) {
                    // Check if to_pocket belongs to authenticated user
                    if ($value !== null) {
                        $pocket = \App\Models\Pocket::where('id', $value)
                            ->where('user_id', Auth::id())
                            ->first();
                        if (!$pocket) {
                            $fail('Pocket tujuan tidak valid.');
                        }
                    }
                },
                function ($attribute, $value, $fail) {
                    // Check if from_pocket and to_pocket are different
                    if ($this->input('from_pocket') !== null && $value !== null) {
                        if ($this->input('from_pocket') == $value) {
                            $fail('Pocket asal dan tujuan tidak boleh sama.');
                        }
                    }
                },
            ],
            'nominal' => [
                'required',
                'numeric',
                'gt:0',
                'max:100000000',
            ],
            'keterangan' => [
                'nullable',
                'string',
                'max:255',
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
            'from_pocket.exists' => 'Pocket asal tidak ditemukan.',
            'to_pocket.exists' => 'Pocket tujuan tidak ditemukan.',
            'nominal.required' => 'Nominal wajib diisi.',
            'nominal.numeric' => 'Nominal harus berupa angka.',
            'nominal.gt' => 'Nominal harus lebih dari 0.',
            'nominal.max' => 'Nominal maksimal Rp 100.000.000.',
            'keterangan.string' => 'Keterangan harus berupa teks.',
            'keterangan.max' => 'Keterangan maksimal 255 karakter.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        // Convert empty string to null for nullable fields
        if ($this->input('from_pocket') === '') {
            $this->merge(['from_pocket' => null]);
        }
        if ($this->input('to_pocket') === '') {
            $this->merge(['to_pocket' => null]);
        }
    }
}
