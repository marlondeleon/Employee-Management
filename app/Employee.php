<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Employee extends Model
{
    protected $fillable = [];

    public function payhistory()
    {
        return $this->hasMany('App\PayHistory', 'employees_id', 'id');
    }

    public static function getBalancePerEmployee()
    {
        $employees = Employee::leftJoin('pay_histories', 'pay_histories.employees_id', '=', 'employees.id')
                        ->select('employees.*', DB::raw('sum(pay_histories.amount) as balance')) 
                        ->groupBy('employees.id')
                        ->get();
        return $employees;
    }
}
