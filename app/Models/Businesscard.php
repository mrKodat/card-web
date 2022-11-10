<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Businesscard extends Model
{
    use HasFactory;
    protected $table = 'business_card';
    public function timings_info(){
        return $this->hasOne('App\Models\Timings','id', 'vendor_id')->select('*');
    }
}
