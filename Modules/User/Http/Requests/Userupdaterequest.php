<?php
namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Userupdaterequest extends FormRequest
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
            'email' => 'required|email:rfc,dns',
            'mobile' => 'required|max:10',
            'role' => 'required',
        ];
    }
}