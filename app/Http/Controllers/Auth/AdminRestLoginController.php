<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;


class AdminRestLoginController extends Controller
{    public int $failStatus =500;
    public int $successStatus=200;
    public int $validationStatus=401;


    public function __construct()
    {
        $this->middleware('guest:admin-api', ['except' => ['logout']]);
    }

    public  function login(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'email'  =>'required|email',
                'password' =>'required|min:6',]);
            if ($validator->fails()) {
                return response()->json(['error'=>$validator->errors()], $this->validationStatus);
            }
            // Attempt to log the user in
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                $admin = Auth::guard('admin')->user();
                $success['token'] =$admin->createToken("MYApp")->accessToken;

                // if successful, then redirect to their intended location
                return response()->json(["data"=>$success],$this->successStatus);
            }
            else{
                return response()->json(["error","unable to login"],$this->failStatus);
        }
        }
        catch (\Exception $exception){
            return response()->json([
                "error_code" =>$exception->getCode(),
                'message'    =>$exception->getMessage(),
            ]);
        }

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
