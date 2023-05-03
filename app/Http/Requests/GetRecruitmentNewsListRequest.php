<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetRecruitmentNewsListRequest extends FormRequest
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
            'employer_id' => 'nullable|integer|exists:employers,id',
            'master_technical_id' => 'nullable|integer|exists:master_technicals,id',
            'master_level_id' => 'nullable|integer|exists:master_levels,id',
            'title' => 'nullable|string|max:255',
            'salary' => 'nullable|integer',
            'order_by' => 'required|string|in:desc,asc',
        ];
    }
}
