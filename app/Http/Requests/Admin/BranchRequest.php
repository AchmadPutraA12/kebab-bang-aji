<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BranchRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:300',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama Cabang wajib diisi.',
            'name.string' => 'Nama Cabang harus berupa teks.',
            'name.max' => 'Nama Cabang maksimal 255 karakter.',

            'address.required' => 'Alamat Cabang wajib diisi.',
            'address.string' => 'Alamat Cabang harus berupa teks.',
            'address.max' => 'Alamat Cabang maksimal 300 karakter.',
        ];
    }
}
