<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        $id = App\Clients::addClient($request->email, $request->fio);
        if ($id) return redirect()->route('index');       
    }

    public function show($id)    {        
        App\Clients::$id = $id;
        $client = App\Clients::getClient();        
        return view('client', compact('client'));
    }

    public function enter($id, Request $request)
    {
       $request->validate([
            'addmoney' => 'nullable|numeric|between:1,10000',         
            'backmoney' => 'nullable|numeric|between:1,' . App\Clients::getBalance($id),         
            'status' => 'nullable',
        ]);
       App\Clients::$id = $id;
        App\Clients::changeClient($request->all());
        return $this->show($id); 
    }
}
