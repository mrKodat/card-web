<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';

    public function plans_info(){
        return $this->hasOne('App\Models\Plans','id', 'plan_id')->select('id', 'name', 'duration');
    }
    public function users_info(){
        return $this->hasOne('App\Models\User','id', 'vendor_id')->select('id', 'name', 'purchase_date');
    }
    public function paymentmethod_info(){
        return $this->hasOne('App\Models\Paymentmethod','id', 'payment_type')->select('id', 'payment_name');
    }
}
