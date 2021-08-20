<?php
namespace Modules\Booking\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddBookingRequest extends FormRequest
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
            'movie_name' => 'required|max:55',
            'movie_type' => 'required',
            'theater_name' => 'required',
            'theater_type' => 'required',
            'showtime' => 'required',
            'price' => 'required',
            'full_name' => 'required|max:55',
            'email' => 'required|max:55',
            'seats' => 'required|integer',
        ];
    }
}