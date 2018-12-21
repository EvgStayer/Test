<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
   

    public function useraddform()
    {      
        return view('useradd');
    }

    public function useradd(Request $request)
    {
       $request->validate([
            'email' => 'required|email',         
            'fio' => 'required|string|max:50',
        ]);
        $id = App\Clients::addUser($request->email, $request->fio);
        if ($id) return $this->user($id); 
        return view('useradd');
    }

    public function user($id)    {
        
        $user = App\Clients::getUser($id);        
        return view('user', compact('user'));
    }

}