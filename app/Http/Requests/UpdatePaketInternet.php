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
        'paket_internet' => [
            'nullable',
            'string',
            'in:' . implode(',', PaketInternet::Paket_Internet),
            'required_without:nama_paket',
        ],
        'nama_paket' => [
            'nullable',
            'string',
            'max:150',
            'required_without:paket_internet',
        ],
        'harga_bulanan' => ['sometimes', 'numeric', 'min:0'],
        'is_active' => ['sometimes', 'boolean'],
    ];
}




    public function messages(): array
    {
        return [

            'paket_internet.in' => 'Paket internet tidak valid.',
            'paket_internet.required' => 'Paket internet harus dipilih.',

            'harga_bulanan.numeric' => 'Harga bulanan harus berupa angka.',
            'harga_bulanan.min' => 'Harga bulanan tidak boleh kurang dari 0.',

            'is_active.boolean' => 'Status aktif harus berupa true/false.',
        ];
    }

}
