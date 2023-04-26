<?php

namespace App\Http\Requests;

use App\Models\Candidate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCandidateRequest extends FormRequest
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
        $candidate = Candidate::findOrFail(request()->id);
        return [
            'email' => 'required|email|max:255|unique:users,email,' . $candidate->user->id,
            'name' => 'required|string|max:255',
            'gender' => 'required|integer|in:' . implode(',', array_keys(Candidate::$genders)),
            'phone_number' => 'required|digits:10|unique:candidates,phone_number,' . $candidate->id,
            'address' => 'required|string|max:255',
        ];
    }
}
