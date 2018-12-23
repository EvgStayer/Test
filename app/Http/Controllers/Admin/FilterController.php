<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

use App\Clients;

class FilterController extends Controller
{
    public function index()
    {
        $items = Clients::all();
        return view('admin', compact('items'));
    }

    public function show(Request $request)
    {
        $request->validate([
            'email' => 'nullable|string',         
            's_balance' => 'nullable|numeric',
            'if_balance' => ['nullable',Rule::in(['>', '<', '='])],
        ]);
      
        $items = Clients::filters($request->all());
        return view('admin', compact('items'));
    }
}
