<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use Modules\User\Entities\User;
use Modules\User\Http\Requests\UserRegisterRequest;
use Modules\User\Http\Requests\UserSignInRequest;
use Illuminate\Validation\ValidationException;
use Modules\User\Http\Resources\UserResource;
use App\Mail\UserMail;
use Mail;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api-system-user'])->except([
            'login',
            'register',
            'profile',
            'logout',
            'forgot',
            'reset'
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

    public function forgot(Request  $request)
    {
        $data  = $request->input('email');

        $users = User::where('email', $data)->first();
        $randomId = rand(1279234, 973480000);
        $users->password =  $randomId;
        $users->save();
        $contain = [
            'code' =>  $randomId,
            'email' =>   $data
        ];

        Mail::to($data)->send(new UserMail($contain));

        return 'A message has been sent to Mailtrap!';
    }

    public function reset(Request  $request)
    {
        $code = $request->input('code');
        $cpassword  = $request->validate(['password' => 'required|min:6|confirmed']);


        $users = User::where('password', $code)->first();
        $users->password = bcrypt($cpassword['password']);
        $users->save();

        return response([
            'data' => $users,
        ]);
    }
}
