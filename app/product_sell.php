<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class product_sell extends Model
{

  protected $table = 'product_sell';
  public $timestamps = false;

  public $fillable = [
      'Prosell_ID','User_Name', 'Prosell_Quantity', 'Prosell_totalPirce','Prosell_send','Prosell_creat'
  ];
}