<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class questiondetail extends Model
{

  protected $table = 'questiondetail';
  public $timestamps = false;

  public $fillable = [
      'quesde_id','ques_id', 'User_ID', 'quesde_detail','quesde_date'
  ];
}
