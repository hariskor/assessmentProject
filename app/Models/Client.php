<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = array('name','surname');

    public function payments()
    {
        return $this->hasMany(Payment::class, 'client_id', 'id');
    }

    public function latestPayment($startDate,$endDate){
        return $this->payments()
            ->where('payments.created_at','>=',$startDate)
            ->where('payments.created_at','<=',$endDate)
            ->orderBy('created_at','desc')
            ->first();
    }
    
}
