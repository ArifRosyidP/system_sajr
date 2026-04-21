<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PekerjaanRequest extends FormRequest
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
            'nama_pekerjaan' => ['required','min:3','max:255',Rule::unique('pekerjaans', 'nama_pekerjaan')
                    ->ignore($this->id, 'id')],
            'kode' => 'nullable|string|min:3|max:255',
            'id_klien' => 'required|string|exists:clients,id',
        ];
    }
}
