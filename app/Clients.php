<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    const UPDATED_AT = null;

    public static $id = 0;

    public static function filters($value)
    {
        $query = "email like '%{$value['email']}%'";
        if ($value['s_balance'] != '') {
            $query .= " AND balance {$value['if_balance']} {$value['s_balance']}";
        }
        return static::whereraw($query)->get();
    }

    public static function addClient($email, $fio)
    {
        return static::insertGetId(
            ['email' => $email , 'fio' => $fio]
        );
    }

    public static function changeClient($value)
    {
        if (isset($value['status'])) {
            static::where('id', self::$id)->update(['status' => 0]);
        }
        if ($value['addmoney']) {
            static::where('id', self::$id)->increment('balance', $value['addmoney']);
            static::unBlock();
        }
        if ($value['backmoney']) {
            static::where('id', self::$id)->increment('balance', -$value['backmoney']);
        }
    }

    public static function getClient($id)
    {
        return static::where('id', $id)->first();
    }

    public static function getBalance()
    {
        return static::where('id', self::$id)->value('balance');
    }

    public static function getStatus()
    {
        return static::where('id', self::$id)->value('status');
    }

    private static function unBlock()
    {
        if (static::getBalance() >= 10 && !static::getStatus()) {
            static::where('id', self::$id)->increment('balance', -10);
            static::where('id', self::$id)->update([
                'status' => 1, 
                'last_payment' => date('Y-m-d'),
                'next_payment' => date('Y-m-d', strtotime('+1 month'))
            ]);
        }
    }
}
