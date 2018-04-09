<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class address extends Model
{

  protected $table = 'address';
  public $timestamps = false;



  public $fillable = [
      'address_id','User_ID','address_name','address_at'
  ];
}
