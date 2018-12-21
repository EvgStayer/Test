<?php

namespace App;
use App\Http\Requests;
use Illuminate\Database\Eloquent\Model;


class Clients extends Model
{
    public static function filters($request) {
    	$query = "email like '%{$request['email']}%'";
    	if ($request['s_balance'] != '')  $query .= " AND balance {$request['if_balance']} {$request['s_balance']}";
    	 return static::whereraw($query)->get();
    }

    public static function getClient($id) {    	
    	$user = static::where('id', $id)->limit(1)->get();
    	return $user[0];
    }  

    public static function addClient($request) {    	
    	 return static::insertGetId(
            ['email' => $request->email , 'fio' => $request->fio]
        );
    }
}
