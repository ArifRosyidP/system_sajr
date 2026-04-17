<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|min:3|max:255',
            'alamat' => 'nullable|string|min:10|max:255|regex:/^[a-zA-Z0-9\s.,\-\/#()]+$/',
            // 'nomor_hp' => 'required|string|max:20',
            // 'nomor_hp' => 'nullable|regex:/^(\+62|62|0)8[1-9][0-9]{6,9}$/',
            // 'npwp' => 'nullable|regex:/^(\d{15}|\d{16}|\d{2}\.\d{3}\.\d{3}\.\d-\d{3}\.\d{3})$/',
            'nomor_hp' => 'nullable|string|max:20',
            'npwp' => 'nullable|digits_between:15,16',
            // 'npwp' => 'nullable|digits_between:15,16',
        ];
    }
}
