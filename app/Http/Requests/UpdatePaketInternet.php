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
                'nama_paket' => ['nullable', 'string', 'max:150'],
                'paket_internet' => ['nullable', 'string', 'in:' . implode(',', PaketInternet::Paket_Internet)],
                'harga_bulanan' => ['nullable',  'numeric', 'min:0'],
                'is_active' => ['sometimes', 'boolean'],
            ];
        }


    public function messages(): array
    {
        return [

            'harga_bulanan.numeric' => 'Harga bulanan harus berupa angka.',
            'harga_bulanan.min' => 'Harga bulanan tidak boleh kurang dari 0.',

            'is_active.boolean' => 'Status aktif harus berupa true/false.',
        ];
    }

}
