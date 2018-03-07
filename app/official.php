<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class official extends Model
{

  protected $table = 'official';
  protected $primaryKey = 'official_ID';
public $timestamps = false;
  public $fillable = [
      'official_ID', 'official_Name', 'official_Email','official_Role','official_cotton','info','product','hotnews','activity	','prison',
      'official_Password','offcreated_at','offupdated_at'
  ];
}
