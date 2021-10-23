<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;
use JWTAuth;
use Illuminate\Support\Facades\Log;
use Pusher\Pusher;


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {

    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
    	$validator = Validator::make($request->only(['login_id', 'password']), [
            'login_id' => 'required',
            'password' => 'required|string|min:4',
        ]);

        if ($validator->fails()) {
            return response()->json(['msg' => $validator->errors(), 'success' => false], 200);
        }

        if (! $token = JWTAuth::attempt($validator->validate())) {
            return response()->json(['msg' => 'Unauthorized', 'success' => false], 200);
        }
        return $this->createNewToken($token);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'employee_name' => 'required|string|between:1,100',
            'employee_id' => 'required|string|between:1,100|unique:users',
            'login_id' => 'required|string|max:100|unique:users',
            'password' => 'required|string|min:6',
            'department_id' => 'required'
            // 'password' => 'required|string|confirmed|min:6',
        ]);

        if($validator->fails()) {
            return response()->json([
                'error' => [
                    $validator->errors()->toJson()
                ],
                'success' => false
            ], 200);
        }

        $upload_path = public_path('upload/avatar');
        
        $file = $request->file('avatar');

        $generated_new_name = '';

        $user = new User();

        if ($file) {
            $generated_new_name = time() . '.' . 'jpg';
            $request->file('avatar')->move($upload_path, $generated_new_name);
            $user->avatar_url = $upload_path."/".$generated_new_name;
        }

        $user->employee_id = $request->employee_id;
        $user->employee_name = $request->employee_name;
        $user->login_id = $request->login_id;
        $user->hire_date = $request->hire_date;
        $user->leave_date = $request->leave_date;
        $user->role = $request->role;
        $user->department_id = $request->department_id;
        $user->note = $request->note;
        $user->affiliation = $request->affiliation;
        $user->mygoal = $request->mygoal;
        $user->password = $request->password;
        $user->save();
        // $user = User::create([
        //     'employee_id' => $request->employee_id,
        //     'employee_name' => $request->employee_name,
        //     'login_id' => $request->login_id,
        //     'hire_date' => $request->hire_date,
        //     'leave_date' => $request->leave_date,
        //     'role' => $request->role,
        //     'department_id' => $request->department_id,
        //     'note' => $request->note,
        //     'affiliation' => $request->affiliation,
        //     'mygoal' => $request->mygoal,
        //     'avatar_url' => $upload_path."/".$generated_new_name,
        //     'password' => bcrypt($request->password)
        // ]);

        return response()->json([
            'success' => true,
            'msg' => [
                'desc' => 'User successfully registered',
                'user' => $user
            ]
        ], 200);
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->logout();

        return response()->json(['msg' => 'User successfully signed out', 'success' => true]);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        return response()->json([
            'msg' => [
                'user' => auth()->user(),
                // 'token' => JWTAuth::refresh(JWTAuth::getToken())
            ],
            'success' => true
        ], 200);
    }

    public function getAuth(Request $request) {
        $channel=$request->channel_name;
        $socketId = $request->socket_id;
        $pusher = new Pusher(config('broadcasting.connections.pusher.key'), config('broadcasting.connections.pusher.secret'), config('broadcasting.connections.pusher.app_id'));
        $auth=$pusher->socket_auth($channel, $socketId);
        Log::info([$auth]);
        return response()->json($auth);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'success' => true,
            'msg' => [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL(),
                'user' => auth()->user()
            ]
        ]);
    }
}