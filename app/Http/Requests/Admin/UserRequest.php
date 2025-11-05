<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id');

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'integer'],
            'branch_id' => ['nullable', 'integer'],
        ];

        if ($this->isMethod('post')) {
            $rules['email'] = ['required', 'email', 'unique:users,email'];
            $rules['username'] = ['required', 'string', 'unique:users,username'];
            $rules['password'] = ['required', 'string', 'min:6'];
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['email'] = ['required', 'email', Rule::unique('users', 'email')->ignore($id)];
            $rules['username'] = ['required', 'string', Rule::unique('users', 'username')->ignore($id)];
            $rules['password'] = ['nullable', 'string', 'min:6'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.integer' => 'Kategori harus berupa angka.',
        ];
    }
}
