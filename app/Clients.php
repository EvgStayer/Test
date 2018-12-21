<?php

namespace App;
use Illuminate\Database\Eloquent\Model;


class Clients extends Model
{
    const UPDATED_AT = null;

    public static function filters($value) {
    	$query = "email like '%{$value['email']}%'";
    	if ($value['s_balance'] != '')  $query .= " AND balance {$value['if_balance']} {$value['s_balance']}";
    	 return static::whereraw($query)->get();
    }

    public static function getClient($id) {    	
    	return static::where('id', $id)->first();
    }  

    public static function addClient( $email, $fio ) {        
         return static::insertGetId(
            ['email' => $email , 'fio' => $fio]
        );
    }   

    public static function changeClient($id, $value) {   
        if (isset($value['status'])) 
            static::where('id', $id)->update(['status' => 0]);
        if ($value['addmoney']) {
            static::where('id', $id)->increment('balance', $value['addmoney']);
            static::unBlock($id);
        }
        if ($value['backmoney']) 
            static::where('id', $id)->increment('balance', -$value['backmoney']);         
    }

    private static function unBlock($id) {
        if (static::getBalance($id) >= 10 && !static::getStatus($id)) {
            static::where('id', $id)->increment('balance', -10);
            static::where('id', $id)->update(['status' => 1, 'last_payment' => date('Y-m-d'), 'next_payment' => date('Y-m-d' , strtotime('+1 month'))]);
        }
    }   

    public static function getBalance($id) {        
         return static::where('id', $id)->value('balance');
    }    

    public static function getStatus($id) {        
         return static::where('id', $id)->value('status');
    }
}
