<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class CreateEmployerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|max:255',
            'role' => 'required|integer|in:' . implode(',', array_keys(User::$roles)),
            'company_name' => 'required|string|max:255',
            'phone_number' => 'required|digits:10|unique:employers,phone_number',
            'address' => 'required|string|max:255',
        ];
    }
}
