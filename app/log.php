<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class log extends Model
{

  protected $table = 'log';
public $timestamps = false;
  public $fillable = [
      'Log_ID','official_ID','table_log','project_log', 'Log_Event', 'Log_IP','Log_Time'
  ];
}
