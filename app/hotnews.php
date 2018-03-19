<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class hotnews extends Model
{

  protected $table = 'hotnews';
  public $timestamps = false;

  public $fillable = [
      'Hotnews_ID','Log_ID','Hotnews_Name','Hotnews_detail','Hotnews_img','datefirst','datelast','hotcreated_at','hotupdated_at','Hotnews_type'
  ];
}
