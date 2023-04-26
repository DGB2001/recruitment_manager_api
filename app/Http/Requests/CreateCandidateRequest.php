<?php

namespace App\Http\Requests;

use App\Models\Candidate;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class CreateCandidateRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'gender' => 'required|integer|in:' . implode(',', array_keys(Candidate::$genders)),
            'phone_number' => 'required|digits:10|unique:candidates,phone_number',
            'address' => 'required|string|max:255',
        ];
    }
}
