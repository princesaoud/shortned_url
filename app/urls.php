<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class urls extends Model
{
    protected $casts = [
      'url'=>'string'
    ];
    protected $fillable = ['url', 'shortened','created_at','updated_at'];

    public static function getUniqueUrl(){
      // $dm stand for Domaine Name
          $dm = str_random(5);
          if(static::whereShortened($dm)->count() != 0){
            return static::getUniqueUrl();
          }
          return $dm;
    }
}
