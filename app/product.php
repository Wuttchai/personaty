<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class product extends Model
{

  protected $table = 'product';
  public $timestamps = false;

  public $fillable = [
      'Pro_ID', 'Log_ID', 'Pro_Name','Pro_Price','Pro_Detail','Pro_Type','Pro_img','Pro_Count','procreated_at'
      ,'proupdated_at'
  ];
}
