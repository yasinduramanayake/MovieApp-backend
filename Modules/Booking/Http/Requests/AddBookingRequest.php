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
            'thater_name' => 'required',
            'theater_type' => 'required',
            'showtime' => 'required',
            'price' => 'required|double',
            'image' => 'required',
            'full_name' => 'required|max:55|unique:bookings,full_name',
            'email' => 'required|max:55|unique:bookings,email',
            'seats' => 'required|integer',
        ];
    }
}
