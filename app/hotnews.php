<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class info extends Model
{

  protected $table = 'hotnews';
  public $timestamps = false;

  public $fillable = [
      'Hotnews_ID', 'Hotnews_Name', 'Hotnews_Num','Hotnews_Type','hotcreated_at','hotupdated_at'
  ];
}
