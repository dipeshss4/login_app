<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminRestDashboard extends Controller
{


    public function index(){
        return response()->json([
            "data"=>"this is admin dashboard"
        ]);
    }
}
