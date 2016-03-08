<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon;

use File;

use Validator;

use PDF;

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

    public function csvusercreate(Request $request)
    {
        if ($request->user()->name != "admin") return redirect()->route('home');

        if (File::exists(storage_path('app/users.csv')))
        {
            $csv = array_map('str_getcsv', file(storage_path('app/users.csv')));
            array_walk($csv, function(&$a) use ($csv) {
                $a = array_combine($csv[0], $a);
            });
            array_shift($csv); # remove column header
            foreach($csv as $user)
            {
                $validator = Validator::make($user, [
                    'name' => 'required|unique:users',
                    'email' => 'required|unique:users',
                    'password' => 'required'
                ]);

                $user['password'] = bcrypt($user['password']);

                if (!$validator->fails()) {
                    \App\User::create($user);
                }
            }
        }

        return redirect()->route('superuser.useradmin');
    }

    public function pdfsheet(Request $request)
    {
    	if ($request->user()->name != "admin") return redirect()->route('home');

        if (File::exists(storage_path('app/users.csv')))
        {
            $csv = array_map('str_getcsv', file(storage_path('app/users.csv')));
            array_walk($csv, function(&$a) use ($csv) {
                $a = array_combine($csv[0], $a);
            });
            array_shift($csv); # remove column header
        }

        set_time_limit(120);
        $pdf = PDF::loadView('pdf.sheet', [
            'users' => $csv,
            'url' => 'argue.app',
            'questionnaireUrl' => 'questionaireArgue.app'
            ]);
        return $pdf->download('usersheet.pdf');
    }

    public function userAdmin(Request $request)
    {
        if ($request->user()->name != "admin") return redirect()->route('home');

        return view('static.useradmin');
    }

    public function createUser(Request $request)
    {
        if ($request->user()->name != "admin") return redirect()->route('home');

        $user = \App\User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
            'password' => bcrypt($request->input('password')),
        ]);

        return redirect()->route('superuser.useradmin');
    }

    public function deleteUser(Request $request, $user)
    {
        if ($request->user()->name != "admin") return redirect()->route('home');

        $user->delete();

        return redirect()->route('superuser.useradmin');
    }
    
}
