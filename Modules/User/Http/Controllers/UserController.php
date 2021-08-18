<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use Modules\User\Entities\User;
use Modules\User\Http\Resources\UserResourceCollection;
use Modules\User\Http\Requests\UserRegisterRequest;
use Modules\User\Http\Requests\Userupdaterequest;
use Spatie\QueryBuilder\QueryBuilder;
use Modules\User\Http\Resources\UserResource;

class UserController extends Controller
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
     *   * @return UserResourceCollection
     * @return ResponseFactory|Response
     */
    public function index(Request $request)
    {
        return response()->json([
            'data' => UserResourceCollection::make(
                QueryBuilder::for(User::class)
                    ->defaultSort('-id')
                    ->allowedFilters(['name', 'email', 'mobile', 'role'])
                    ->allowedSorts(['name', 'email', 'mobile', 'role'])
                    ->paginate($request->input('per_page', 10))
            ),
        ]);
    }
    /**
     * @param UserRegisterRequest $request
     * @return ResponseFactory|Response
     */
    public function store(UserRegisterRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);

        $userdata = User::create($data);

        return response([
            'data' => $userdata,
            'token' => $userdata->createToken('api-system-user')->accessToken,
        ]);
    }

    /**
     * @return UserResource
     * @return ResponseFactory|Response
     */
    public function show(User $user)
    {
        return response()->json(['success' => UserResource::make($user)]);
    }

    /**
     * @return ResponseFactory|Response
     * @param Userupdaterequest $request
     */
    public function update(Userupdaterequest $request, User $id)
    {
        $data = $request->validated();
        $id->update($data);
        return response()->json(['data' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *   * @return User
     */
    public function destroy(User $id)
    {
        return response()->json(['successfully deleted' => $id->delete()]);
    }
}
