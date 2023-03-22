<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UserResource\UserResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Arr;
use Intervention\Image\Facades\Image;
use Validator;
use Response;
use Session;
use Auth;
use Hash;
use DB;



class UserController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|min:2|max:255',
            'email' => 'nullable|email|unique:users',
            'phone' => 'required|max:15|unique:users',
            'password' => 'required|min:6',
            'role_id' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
            'avatar' => 'nullable|image',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(),400);
        }
        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        if(Arr::has($data, 'avatar')){
            $data['avatar'] = (Arr::pull($data, 'avatar'));
            Image::make($data['avatar'])->resize(600,500);
            $data['avatar'] = (Arr::pull($data, 'avatar'))->store('brands');
        }

        try {
            $user = User::create($data);

            return response()->json([
                'message'=>'Registration Successfully Done.',
                'user' => $user
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'exception' => $exception
            ]);
        }
    }

    // login 
    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(),400);
        }

        if (!$token = auth('api')->attempt($validator->validated())) {
            return response()->json([
                'message' =>'Unauthorized',
                'code' =>'403',
            ]);
        }

        return $this->respondWithToken($token);
    }

    // token response
    protected function respondWithToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' =>'bearer',
            'expires_in' =>auth('api')->factory()->getTTL()*60 
        ]);
    }

    // profile

    public function profile(){
        return response()->json(new UserResource(auth()->user()));
    }

    //logout
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    // update user 

    public function update(Request $request){
        $data = $request->all();
        if(Arr::has($data, 'avatar')){
            $data['avatar'] = (Arr::pull($data, 'avatar'));
            Image::make($data['avatar'])->resize(600,500);
            $data['avatar'] = (Arr::pull($data, 'avatar'))->store('users');
        }
        try {
            User::where('id',auth()->user()->id)->update($data);
            
            return response()->json([
                'message'=>'Information Updated.',
            ]);

        } catch (\Exception $exception) {
            return response()->json([
                'error' => $exception
            ]);
        }
    }

}
