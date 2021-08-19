<?php

namespace Modules\Booking\Http\Controllers;

use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use Modules\Booking\Entities\Booking;
use Modules\Booking\Http\Resources\BookingResourceCollection;
use Modules\Booking\Http\Requests\AddBookingRequest;
use Modules\Booking\Http\Requests\UpdateBookingRequest;
use Spatie\QueryBuilder\QueryBuilder;
use Modules\Booking\Http\Resources\BookingResource;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api-system-user'])->except([
            'index',
            'store',
            'update',
            'destroy',
        ]);
    }

    /**
     *   * @return BookingResourceCollection
     * @return ResponseFactory|Response
     */
    public function index(Request $request)
    {
        return response()->json([
            'data' => BookingResourceCollection::make(
                QueryBuilder::for(Booking::class)
                    ->defaultSort('-id')
                    ->allowedFilters([
                        'movie_name',
                        'theater_name,theater_type,movie_type,full_name,email',
                    ])
                    ->allowedSorts([
                        'movie_name',
                        'theater_name,theater_type,movie_type,full_name,email',
                    ])
                    ->paginate($request->input('per_page', 10))
            ),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param AddBookingRequest $request
     * @return ResponseFactory|Response
     */
    public function store(AddBookingRequest $request)
    {
        $data = $request->validated();
        $bookingdata = Booking::create($data);

        return response()->json([
            'data' => $bookingdata,
        ]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('booking::show');
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateBookingRequest $request
     * @param int $id
     *   @return ResponseFactory|Response
     */
    public function update(UpdateBookingRequest $request, Booking $id)
    {
        $data = $request->validated();
        $id->update($data);

        return response()->json([
            'data' => $id,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return ResponseFactory|Response
     */
    public function destroy(Booking $id)
    {
        return response()->json(['successfully deleted' => $id->delete()]);
    }
}
