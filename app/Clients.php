<?php

namespace App;
use App\Http\Requests;
use Illuminate\Database\Eloquent\Model;


class Clients extends Model
{
    const UPDATED_AT = null;

    public static function filters($request) {
    	$query = "email like '%{$request['email']}%'";
    	if ($request['s_balance'] != '')  $query .= " AND balance {$request['if_balance']} {$request['s_balance']}";
    	 return static::whereraw($query)->get();
    }

    public static function getClient($id) {    	
    	return static::where('id', $id)->first();
    }  

    public static function addClient($request) {        
         return static::insertGetId(
            ['email' => $request->email , 'fio' => $request->fio]
        );
    }   

    public static function getBalance($id) {    	
    	 return static::where('id', $id)->value('balance');
    }

    public static function changeClient($id, $request) {    
        if ($request->status) 
            static::where('id', $id)->update(['status' => 0]);
        if ($request->addmoney) {
            static::where('id', $id)->increment('balance', $request->addmoney);
            static::unBlock($id);
        }
        if ($request->backmoney) 
            static::where('id', $id)->increment('balance', -$request->backmoney);         
    }

    private static function unBlock($id) {
        if (static::getBalance($id) >= 10) {
            static::where('id', $id)->increment('balance', -10);
            static::where('id', $id)->update(['status' => 1, 'last_payment' => date('Y-m-d'), 'next_payment' => date('Y-m-d' , strtotime('+1 month'))]);
        }
    }   
}
