<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PurchasingorderRequest extends FormRequest
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
            'tanggal_po' => 'required|date',
            'id_klien' => 'required|exists:clients,id',
            'id_pekerjaan' => 'nullable|exists:pekerjaans,id',
            'id_subkontraktor' => 'nullable|exists:subkontraktors,id',
            'nomor_po' => 'required|string|max:50',
            'pajak' => 'nullable|string|max:3',
            'id_suplier' => 'required|exists:supliers,id',
            'nama_barang' => 'required|string|exists:suplier,id',
            'kuantitas' => 'required|numeric|min:1',
            'satuan' => 'required|string|min:2|max:50',
            'harga_satuan' => 'required|numeric|min:0',
            'jumlah' => 'required|numeric|min:0', // hati hati eror disini
            'transprtasi' => 'nullable|numeric|min:0',
            'termofpayment' => 'required|string|min:3|max:50',
            'tanggal_pengiriman' => 'required|date|after_or_equal:tanggal_po',
            'id_personincharge' => 'required|exists:personincharges,id',
            'tujuan' => 'required|string|max:255',
            'catatan' => 'nullable|string|max:500',
            'invoice' => 'nullable|string|max:100',
            'tanggal_invoice' => 'nullable|date',
            'no_bukti' => 'nullable|string|max:100',
            'status' => 'nullable|string',
            'total_po' => 'nullable|numeric|min:0',
            'totalbayar_co' => 'nullable|numeric|min:0',
            'sisa_status' => 'nullable|string|max:50',
            'tanggal_bayar' => 'nullable|date',
            'dp1' => 'nullable|boolean',
            'pelunasan1' => 'nullable|boolean',
            'dp2' => 'nullable|boolean',
            'pelunasan2' => 'nullable|boolean'
        ];
    }
}
