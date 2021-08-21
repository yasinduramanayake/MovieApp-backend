<?php
namespace Modules\Movie\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddMovieRequest extends FormRequest
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
            'name' => 'required|max:55|unique:movies,name',
            'type' => 'required',
            'image' => 'required',
            'description' => 'max:5000',
            'theaters' => 'nullable|array',
        ];
    }
}
