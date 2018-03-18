<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class doccument extends Model
{

  protected $table = 'doccument';
  public $timestamps = false;

  public $fillable = [
      'doc_id','Log_ID','doc_name','doc_file','doc_datecre','doc_dateup'
  ];
}
