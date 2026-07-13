<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreSendTransferRequest extends FormRequest
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
            'email_penerima' => [
                'required',
                'email',
                'exists:users,email',
                function ($attribute, $value, $fail) {
                    // Check if email belongs to current user
                    if ($value === Auth::user()->email) {
                        $fail('Tidak boleh transfer ke diri sendiri.');
                    }
                },
            ],
            'pocket_id' => [
                'nullable',
                'exists:pockets,id',
                function ($attribute, $value, $fail) {
                    // Check if pocket belongs to authenticated user
                    if ($value !== null) {
                        $pocket = \App\Models\Pocket::where('id', $value)
                            ->where('user_id', Auth::id())
                            ->first();
                        if (!$pocket) {
                            $pocket = $fail('Pocket tidak valid.');
                        }
                    }
                },
            ],
            'nominal' => [
                'required',
                'numeric',
                'min:1000',
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
            'email_penerima.required' => 'Email penerima wajib diisi.',
            'email_penerima.email' => 'Email penerima tidak valid.',
            'email_penerima.exists' => 'Email penerima tidak ditemukan.',
            'nominal.required' => 'Nominal wajib diisi.',
            'nominal.numeric' => 'Nominal harus berupa angka.',
            'nominal.min' => 'Nominal minimal Rp 1.000.',
            'nominal.max' => 'Nominal maksimal Rp 100.000.000.',
            'pocket_id.exists' => 'Pocket tidak ditemukan.',
            'keterangan.string' => 'Keterangan harus berupa teks.',
            'keterangan.max' => 'Keterangan maksimal 255 karakter.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        // Get penerima_id from email
        if ($this->input('email_penerima')) {
            $penerima = \App\Models\User::where('email', $this->input('email_penerima'))->first();
            if ($penerima) {
                $this->merge(['penerima_id' => $penerima->id]);
            }
        }

        // Convert empty string to null for nullable fields
        if ($this->input('pocket_id') === '' || $this->input('pocket_id') === null) {
            $this->merge(['pocket_id' => null]);
        }
    }
}

