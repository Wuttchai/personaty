<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class sell_detail extends Model
{

  protected $table = 'sell_detail';
  public $timestamps = false;

  public $fillable = [
      'Det_ID', 'Pro_ID', 'Det_Num','Det_total'
  ];
}
