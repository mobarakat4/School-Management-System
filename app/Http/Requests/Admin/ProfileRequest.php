<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name'=>'required|min:4',
            'username'=>'nullable|min:4|unique:users,username,'.$this->user()->id,
            'email'=>'required|min:5|email|unique:users,email,'.$this->user()->id,
            'address'=>'nullable',
            'city'=>'nullable',
            'phone'=>'nullable|numeric',
            'photo'=>'nullable|image',
        ];
    }
}
