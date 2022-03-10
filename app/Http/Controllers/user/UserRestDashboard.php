<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserRestDashboard extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public  function index(){
        return response()->json([
            "data" =>"this is user dashboard"
        ],200);
    }
}
