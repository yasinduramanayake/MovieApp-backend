<?php

namespace Modules\Theater\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use Modules\Theater\Entities\Theater;
use Modules\Theater\Http\Resources\TheaterResourceCollection;
use Modules\Theater\Http\Requests\AddTheaterRequest;
use Modules\Theater\Http\Requests\UpdateTheaterRequest;
use Spatie\QueryBuilder\QueryBuilder;

class TheaterController extends Controller
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
     *   * @return TheaterResourceCollection
     * @return ResponseFactory|Response
     */
    public function index(Request $request)
    {
        return response()->json([
            'data' => QueryBuilder::for(Theater::class)
                ->allowedFilters(['name', 'venue'])
                ->allowedSorts(['name', 'type', 'venue'])
                ->paginate($request->query('per_page', 2)),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param AddTheaterRequest $request
     * @return ResponseFactory|Response
     */
    public function store(AddTheaterRequest $request)
    {
        $data = $request->validated();

        $theaterdata = Theater::create($data);

        return response([
            'data' => $theaterdata,
        ]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('theater::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('theater::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateTheaterRequest $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateTheaterRequest $request, Theater $id)
    {
        $data = $request->validated();
        $id->update($data);
        return response()->json(['data' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id

     */
    public function destroy(Theater $id)
    {
        return response()->json(['successfully deleted' => $id->delete()]);
    }
}