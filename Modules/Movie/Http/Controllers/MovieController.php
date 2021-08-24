<?php

namespace Modules\Movie\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use Modules\Movie\Entities\Movie;
use Modules\Movie\Http\Resources\MovieResourceCollection;
use Modules\Movie\Http\Requests\AddMovieRequest;
use Modules\Movie\Http\Requests\UpdateMovierequest;
use Spatie\QueryBuilder\QueryBuilder;
use Modules\Movie\Http\Resources\MovieResource;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api-system-user'])->except([
            'index',
            'store',
            'update',
            'destroy',
            'show',
        ]);
    }

    /**
     *   * @return MovieResourceCollection
     * @return ResponseFactory|Response
     */
    public function index(Request $request)
    {
        return response()->json([
            'data' => QueryBuilder::for(Movie::class)
                ->allowedFilters(['type', 'name'])
                ->allowedSorts(['type'])
                ->paginate($request->query('per_page', 2)),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param AddMovieRequest $request
     * @return ResponseFactory|Response
     */
    public function store(AddMovieRequest $request)
    {
        $data = $request->validated();
        $moviedata = Movie::create($data);

        return response()->json([
            'data' => $moviedata,
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateMovieRequest $request
     * @param int $id
     *      * @return ResponseFactory|Response
     */
    public function update(UpdateMovieRequest $request, Movie $id)
    {
        $data = $request->validated();
        $id->update($data);
        return response()->json(['data' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     *      * @return ResponseFactory|Response
     */
    public function destroy(Movie $id)
    {
        return response()->json(['successfully deleted' => $id->delete()]);
    }
}