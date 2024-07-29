<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminManagementRequest extends FormRequest
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
            'name'=>'nullable|min:4',
            'username'=>'required|min:4|unique:users,username,'.$this->id,
            'email'=>'required|email|unique:users,email,'.$this->id,
            'phone'=>'nullable|min:5|numeric',
            'address'=>'nullable|min:3',
            'city'=>'nullable|min:3',
            'password'=>'nullable|min:3',
            'photo'=>'nullable|image',
        ];
    }
}
