<?php
namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            'name' => 'required|max:55',
            'email' => 'required|unique:users|email:rfc,dns',
            'password' => 'required|min:6|confirmed',
            'mobile' => 'required|unique:users|max:10',
            'role' => 'required',
        ];
    }
}
