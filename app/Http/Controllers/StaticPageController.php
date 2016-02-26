<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class StaticPageController extends Controller
{
    public function help()
    {
    	return view('static.help');
    }

    public function instructions()
    {
    	return view('static.instructions');
    }

    //SUPERUSER BIT

    public function superuser(Request $request)
    {
    	if ($request->user()->name != "admin") return redirect()->route('home');

    	return view('static.superuser');
    }

    public function pdfsheet(Request $request)
    {
    	if ($request->user()->name != "admin") return redirect()->route('home');

    	return view('static.sheet')->with([
    		'url' => 'argue.app',
    		'questionnaireUrl' => 'questionaireArgue.app'
    		]);
    }

    public function newUser(Request $request)
    {
        if ($request->user()->name != "admin") return redirect()->route('home');

        return view('static.newuser');
    }

    public function createUser(Request $request)
    {
        if ($request->user()->name != "admin") return redirect()->route('home');

         $user = App\User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
            'password' => bcrypt($request->input('password')),
        ]);

        return view('static.superuser');
    }
    
}
