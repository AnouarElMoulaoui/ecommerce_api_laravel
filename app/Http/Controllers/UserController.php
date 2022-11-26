<?php

namespace App\Http\Controllers;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Contracts\Service\Attribute\Required;

class UserController extends Controller
{
    //

   public function register(RegisterRequest $requet) {
        $user = User::create([
                'name' => $requet-> name,
                'email' => $requet->email,
                'password' => Hash::make($requet->password),
        ]);
        if($user){
            return response()->json([
                'status' => 200,
                'msg' => 'register success',
                'data' => null
            ]);
        }
        return response()->json([
            'status' => 404,
            'msg' => 'Register faild',
            'data' => null
        ]); 
    }

    public function login(UserRequest $request){
        
        if( auth()->attempt(['email' => $request->email ,'password' => $request->password])){
            $user = auth()->user();
            //$token = $user->createToken("api")->plainTextToken;
            return response()->json([
                'status' => 200,
                'msg' => 'login success',
                'data' => [
                        'user' => $user,
                        'token' => $user->createToken("api")->plainTextToken
                    ]
            ]);
        }
        return response()->json([
            'status' => 404,
            'msg' => 'email or password incorrect',
            'data' => null
        ]);
    }

    public function logout(){
        auth()->user()->currentAccessToken()->delete();
        return response()->json([
            'status' => 200,
            'msg'=> 'logout success',
            'data' => null
        ]);
    }

    public function me(){
        return response()->json([
            'status' => 200,
            'msg'=> '',
            'data' => auth()->user() 
        ]);
    }
}
