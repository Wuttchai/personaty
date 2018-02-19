<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class person extends Model
{

  protected $table = 'person_count';
public $timestamps = false;
  public $fillable = [
      'Person_ID','Log_ID', 'Person_Num','Person_Type','percreated_at','perupdated_at'
  ];
}
