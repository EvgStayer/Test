<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App;

class FilterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $items = App\Clients::all();
        return view('admin', compact('items'));
    }

    public function show(Request $request)
    {
        $request->validate([
            'email' => 'nullable|string',         
            's_balance' => 'nullable|numeric',
        ]);
      
        $items = App\Clients::filters($request->all());
        return view('admin', compact('items'));
    }
}
