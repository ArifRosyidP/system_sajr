<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PersoninchargeRequest extends FormRequest
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
            'nomor_hp' => 'nullable',
            'npwp' => 'nullable',
            // 'npwp' => 'nullable|digits_between:15,16',
        ];
    }
}
