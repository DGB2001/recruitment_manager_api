<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required_if:grantType,' . config('const.grant_type.password') . '|max:256|email',
            'password' => 'required_if:grantType,' . config('const.grant_type.password') . '|max:20',
            'grantType' => 'required|max:255|in:' . implode(',', config('const.grant_type')),
            'refreshToken' => 'required_if:grantType,' . config('const.grant_type.refresh_token') . '|max:255',
        ];
    }

    /**
     * change display default attributes
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'email' => 'メールアドレス',
            'password' => 'パスワード',
            'refreshToken' => 'リフレッシュトークン',
        ];
    }

    /**
     * Custom messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required_if' => ':attributeは、必ず指定してください。',
            'email.regex' => trans('validation.email'),
        ];
    }
}
