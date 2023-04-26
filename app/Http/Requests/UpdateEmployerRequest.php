<?php

namespace App\Http\Requests;

use App\Models\Employer;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployerRequest extends FormRequest
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
        $employer = Employer::findOrFail(request()->id);
        return [
            'email' => 'required|email|max:255|unique:users,email,' . $employer->user->id,
            'company_name' => 'required|string|max:255',
            'phone_number' => 'required|digits:10|unique:employers,phone_number,' . $employer->id,
            'address' => 'required|string|max:255',
        ];
    }
}
