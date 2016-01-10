<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HeartbeatController extends Controller
{
    
    public function beat(Request $request)
    {
        return '<3';
    }
    
}
