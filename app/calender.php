<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class calender extends Model
{

  protected $table = 'calender';
  public $timestamps = false;

  public $fillable = [
      'cal_id','Log_ID','cal_name','cal_last','cal_date'
  ];
}
