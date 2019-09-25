<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayHistory extends Model
{
    public function employee()
    {
        $this->belongsTo('App\Employee', 'employee_id', 'id');
    }
}
