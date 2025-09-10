<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use Carbon\Carbon;

class StorePromosi extends FormRequest
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
            'kode_promosi' => 'required|string|max:50|unique:promosis,kode_promosi',
            'nama_program_promosi' => 'required|string|max:255',
            'periode_mulai' => 'required|date',
            'periode_selesai' => 'required|date|after_or_equal:periode_mulai',
            'note' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'kode_promosi.unique' => 'Kode promosi sudah digunakan.',
            'periode_selesai.after_or_equal' => 'Tanggal selesai tidak boleh sebelum tanggal mulai.',
        ];
    }

    protected function withValidator(Validator $validator)
    {
        $validator->after(function (Validator $validator) {
            $mulai = $this->input('periode_mulai');
            $selesai = $this->input('periode_selesai');

            if ($mulai && $selesai) {
                $mulaiDate = Carbon::parse($mulai);
                $selesaiDate = Carbon::parse($selesai);

                if ($selesaiDate->lt($mulaiDate)) {
                    $validator->errors()->add('periode_selesai', 'Tanggal selesai tidak boleh sebelum tanggal mulai.');
                }
            }
        });
    }


}
