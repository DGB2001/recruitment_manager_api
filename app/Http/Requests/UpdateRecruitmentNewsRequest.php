<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRecruitmentNewsRequest extends FormRequest
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
            'employer_id' => 'required|integer|exists:employers,id',
            'master_technical_id' => 'required|integer|exists:master_technicals,id',
            'master_level_id' => 'required|integer|exists:master_levels,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|integer',
            'quantity' => 'required|integer',
            'expired_at' => 'required|date_format:d-m-Y|after:today',
        ];
    }
}
