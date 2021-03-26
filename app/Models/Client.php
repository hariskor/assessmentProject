<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = array('name','surname');

    public static function boot()
    {
         parent::boot();
         self::creating(function($model){
            $model->created_at = now();
         });

         self::updating(function($model){
             $model->updated_at = now();
         });
    }
    //use HasFactory;
}
