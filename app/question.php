<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class question extends Model
{

  protected $table = 'question';
  public $timestamps = false;

  public $fillable = [
      'ques_id', 'ques_name', 'ques_detail','ques_date','User_ID','ques_type'
  ];
}
