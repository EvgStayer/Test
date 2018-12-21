<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;

class ClientController extends Controller
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
   

    public function showform()
    {      
        return view('newclient');
    }

    public function add(Request $request)
    {
       $request->validate([
            'email' => 'required|email',         
            'fio' => 'required|string|max:50',
        ]);
        $id = App\Clients::addClient($request);
        if ($id) return redirect('/admin');
        return view('newclient');
    }

    public function show($id)    {
        
        $client = App\Clients::getClient($id);        
        return view('client', compact('client'));
    }
}
