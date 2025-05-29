<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = validator::make($request->all(),[
            'name' => 'required|string|max:100',
            'role' => 'required|string|max:100|in:admin,user',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:5|confirmed',

        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        $user = User::create([
            'name' => $request->get('name'),
            'role' => $request->get('role'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);

        return response()->json([
            'message' => 'User created sucessfully',
            'data' => $user,
        ],201);
    }
    public function login(Request $request)
    {
        $validator = validator::make($request->all(),[
            'email' => 'required|string|email|max:100',
            'password' => 'required|string|min:5',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $credentials = $request->only('email', 'password');
        //validate the credentials
        try {
            if(!$token = JWTAuth::attempt($credentials)){
                return response()->json([
                    'message' => 'Invalid credentials'
                ], 401);
            }

            return response()->json([
                'message' => 'Login successful',
                'token' => $token,

            ], 200);

        } catch (JWTException $e) {
            return response()->json([
                'error' => 'Could not create token',
                'message' => $e->getMessage(),
            ], 500);
        }

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function getUser()
    {
        $user = Auth::user();
        return response()->json([
            'message' => 'User retrieved successfully',
            'data' => $user,
        ], 200);
    }


    public function logout()
    {
        try{
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json([
                'message' => 'User logged out successfully',
            ], 200);
        }catch(JWTException $e){
            //if the token is invalid or expired
            return response()->json([
                'error' => 'Could not log out user'
            ], 500);

        }
    }
    //
    public function getAdmin(){
        //muestra todos los usuarios
        $users = User::all();
        return response()->json([
            'message' => 'Users retrieved successfully',
            'data' => $users,
        ], 200);
    }
    public function getUserById($id)
    {
        //muestra un usuario por id
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json([
            'message' => 'User retrieved successfully',
            'data' => $user,
        ], 200);
    }
    public function updateUser(Request $request, $id)
    {
        //actualiza un usuario por id
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:100',
            'role' => 'sometimes|string|max:100|in:admin,user',
            'email' => 'sometimes|string|email|max:100|unique:users,email,' . $id,
            'password' => 'sometimes|string|min:5|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user->update($request->all());
        return response()->json([
            'message' => 'User updated successfully',
            'data' => $user,
        ], 200);
    }
    public function deleteUser($id)
    {
        //elimina un usuario por id
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->delete();
        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
