<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class info extends Model
{

  protected $table = 'info';
  public $timestamps = false;

  public $fillable = [
      'Info_ID', 'Log_ID', 'Info_Name','Info_Img','infocreated_at','infoupdated_at'
  ];
}
