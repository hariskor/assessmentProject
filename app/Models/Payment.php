<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    
    protected $fillable = array('amount');


    public function client(){
        return $this->belongsTo(Client::class,'client_id','id');
    }

}
