<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function _construct(){
        $this->middleware('auth:api',['except' => ['login', 'register']]);
    }
    public function register(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'role' => 'required|in:admin,supervisor,agent',
                'email' => 'required|email|unique:users',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                'date_of_birth' => 'required|date',
                'timezone' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json(['status'=>false,'message'=>'Validation errors','data' => $validator->errors()], 400);
            }

            \Log::info('Register request data via API:', $request->all());

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'role' => $request->role,
                'email' => $request->email,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'date_of_birth' => $request->date_of_birth,
                'timezone' => $request->timezone,
                'password' => bcrypt($request->password),
            ]);

            \Log::info('User created by api side:', $user->toArray());
            return response()->json(['status'=> true,'message' => 'User successfully registered', 'data' => $user], 201);

        } catch (\Exception $e) {
            \Log::error('Authentication error: ' . $e->getMessage());
            return response()->json(['status'=>false, 'message'=> 'Authentication failed.'], 500);
        }
    }
    public function login(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string|min:6',
            ]);
            if ($validator->fails()) {
                return response()->json(['status'=>false,'message'=> 'Validation errors','data' => $validator->errors()], 400);
            }
            if (!$token = auth('api')->attempt($validator->validated())) {
                return response()->json(['status'=>false,'message'=> 'Invalid email or password'], 401);
            }
            \Log::info('User Login via API:', Auth::user()->toArray());

            return response()->json([
                'status'=>true,
                'message'=> 'User successfully loggedin',
                'token_details' => $this->respondWithToken($token),
                'data' => auth()->user()
            ], 200);

        } catch (\Exception $e) {
            \Log::error('Authentication error: ' . $e->getMessage());
            return response()->json(['status'=>false, 'message'=> 'Authentication failed.'], 500);
        }
    }
    public function profile(){
        if(auth()->user()){
            return response()->json(['status'=>true,'message'=> 'Success','data' => auth()->user()], 200);
        }else{
            return response()->json(['status'=>false,'message'=> 'Unauthorized'], 401);
        }
    }

    public function logout(){
        try {
            if(auth()->user()){
                \Log::info('User Logout via API:', Auth::user()->toArray());
                auth()->logout();
                return response()->json(['status'=>true, 'message'=> 'User logged out']);
            }else{
                return response()->json(['status'=>false, 'message'=> 'Unauthorized'], 401);
            }
        } catch (\Exception $e) {
            \Log::error('Logout error: ' . $e->getMessage());
            return response()->json(['status'=>false, 'message'=> 'Logout failed.'], 500);
        }
    }

    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ];
    }
}
