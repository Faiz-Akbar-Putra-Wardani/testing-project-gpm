<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBandwidth extends FormRequest
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
            'nilai' => ['required', 'string', 'max:50'],
        ];
    }

    public function messages()
    {
        return [
            'nilai.required' => 'Nilai harus diisi.',
            'nilai.max' => 'Nilai tidak boleh lebih dari 50 karakter.',
        ];
    }
}
