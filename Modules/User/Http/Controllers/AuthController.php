<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Auth;
use Modules\User\Entities\User;
use Modules\User\Http\Requests\UserRegisterRequest;
use Modules\User\Http\Requests\UserSignInRequest;
use Illuminate\Validation\ValidationException;
use Modules\User\Http\Resources\UserResource;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api-system-user'])->except([
            'login',
            'register',
            'profile',
            'logout',
        ]);
    }

    /**
     * @param UserRegisterRequest $request
     * @return ResponseFactory|Response
     */

    public function register(UserRegisterRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        return response([
            'data' => $user,
            'token' => $user->createToken('api-system-user')->accessToken,
        ]);
    }

    /**
     * @param UserSignInRequest $request
     * @return ResponseFactory|Response
     * @throws ValidationException
     */
    public function login(UserSignInRequest $request)
    {
        if (!Auth::attempt($request->validated())) {
            throw ValidationException::withMessages([
                'login' => 'Invalid Credentials',
            ]);
        }

        return response([
            'data' => auth()->user(),
            'token' => auth()
                ->user()
                ->createToken('api-system-user')->accessToken,
        ]);
    }
    /**
     * Show user profile.
     *
     * @return UserResource
     */

    public function profile()
    {
        return new UserResource(auth('api')->user());
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::user()
                ->AauthAcessToken()
                ->delete();
        }
        return response()->json('Successfully logged out');
    }
}
