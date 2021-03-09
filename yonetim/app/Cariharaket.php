<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cariharaket extends Model
{
  public  function cari(){
      return $this->belongsTo('App\Cari');
  }
}
