<?php

namespace App\Http\Requests;

use App\Models\PaketInternet;
use Illuminate\Foundation\Http\FormRequest;

class StorePaketInternet extends FormRequest
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
   public function rules()
{
    return [
        'paket_internet' => 'required|string',
        'nama_paket'     => 'nullable|string|required_if:paket_internet,Lainnya',
        'harga_bulanan'  => 'required|numeric',
        'is_active'      => 'required|boolean',
    ];
}


    public function messages()
{
    return [

        'paket_internet.required' => 'Paket internet harus dipilih.',
        'paket_internet.in' => 'Paket internet tidak valid.',

        'harga_bulanan.numeric' => 'Harga bulanan harus berupa angka.',
        'harga_bulanan.min' => 'Harga bulanan tidak boleh kurang dari 0.',

        'is_active.boolean' => 'Status aktif harus berupa true/false.',
    ];
}

}
