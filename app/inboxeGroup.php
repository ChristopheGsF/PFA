<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inboxeGroup extends Model
{
  protected $fillable = [
      's_user_id', 'f_user_id', 'hash'
  ];
  public function users()
  {
      return $this->belongsToMany('App\User', 's_user_id', 'f_user_id' );
  }
}
