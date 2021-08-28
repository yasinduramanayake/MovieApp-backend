<?php
namespace Modules\Theater\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddTheaterRequest extends FormRequest
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
            'name' => 'required|max:55|unique:theaters,name',
            'type' => 'required',
            'venue' => 'required',
            'time1' => 'nullable',
            'time2' => 'nullable',
            'time3' => 'nullable',
            'image' => 'required',
            'movies' => 'nullable|array',
            'description' => 'max:5000',
        ];
    }
}
