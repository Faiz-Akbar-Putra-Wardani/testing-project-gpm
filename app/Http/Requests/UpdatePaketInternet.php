<?php

namespace App\Http\Requests;

use App\Models\PaketInternet;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePaketInternet extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
        {
            return [
                'nama_paket' => ['sometimes', 'string', 'max:150'],
                'paket_internet' => ['sometimes', 'string', 'in:' . implode(',', PaketInternet::Paket_Internet)],
                'harga_bulanan' => ['sometimes',  'numeric', 'min:0'],
                'is_active' => ['sometimes', 'boolean'],
            ];
        }


    public function messages(): array
    {
        return [
            'nama_paket.max' => 'Nama paket tidak boleh lebih dari 150 karakter.',

            'paket_internet.in' => 'Paket internet tidak valid.',
            
            'harga_bulanan.numeric' => 'Harga bulanan harus berupa angka.',
            'harga_bulanan.min' => 'Harga bulanan tidak boleh kurang dari 0.',

            'is_active.boolean' => 'Status aktif harus berupa true/false.',
        ];
    }

}
