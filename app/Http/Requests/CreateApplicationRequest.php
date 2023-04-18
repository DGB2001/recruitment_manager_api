<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateApplicationRequest extends FormRequest
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
            'candidate_id' => 'required|integer|exists:candidates,id',
            'master_technical_id' => 'nullable|integer|exists:master_technicals,id',
            'master_level_id' => 'nullable|integer|exists:master_levels,id',
            'recruitment_news_id' => 'nullable|integer|exists:recruitment_news,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:255',
        ];
    }
}
