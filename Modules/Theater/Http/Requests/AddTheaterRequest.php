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
            'time1' => 'max:20',
            'time2' => 'max:20',
            'time3' => 'max:20',
            'image' => 'required',
            'movies' => 'nullable|array',
            'description' => 'max:5000',
        ];
    }
}