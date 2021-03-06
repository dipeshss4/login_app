<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class RestLoginController extends Controller
{
    public $successStatus = 200;
    public function __construct()
    {
        $this->middleware('api', ['except' => ['logout']]);
    }


    public function login(){
        try {
            if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
                $user = Auth::user();
                $success['token'] =$user->createToken("MYApp")->accessToken;

                return response()->json(['success' => $success,'user_id'=>$user->id] ,$this-> successStatus);
            }
            else{
                return response()->json(['error'=>'Unauthorised'], 401);
            }
        }catch (\Exception $exception){
            return  response()->json([
                'error_code'=>$exception->getCode(),
                'error_message'=>$exception->getMessage(),
            ]);
        }


    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')-> accessToken;
        $success['name'] =  $user->name;
        return response()->json(['success'=>$success,
            'user_id'=>$user->id,
            'user_name'=>$user->name,
        ], $this-> successStatus);
    }
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this-> successStatus);
    }
    public function authenticatedUserDetails(){

        return response()->json(['authenticated-user' => auth()->user()], $this->successStatus);
    }
    public function logout(Request $request)
    {
        try {
            if (Auth::check()) {
                $request->user()->token()->revoke();
            }
            return response()->json([
                "data"=>"succesfully logout"
            ],200);
        }
        catch (\Exception $exception){
            return response()->json([
                "error_code" =>$exception->getCode(),
                'message'    =>$exception->getMessage(),
            ]);
        }

    }
}
