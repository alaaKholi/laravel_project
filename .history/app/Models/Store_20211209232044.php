<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
   use HasFactory;
   use SoftDeletes;
   
   protected $is_trend = false;

   public function category()
   {
      return $this->belongsTo('App\Models\Category');
   }
   public function rate()
   {
      return $this->hasMany('App\Models\Rate');
   }
}
