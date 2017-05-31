<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inboxeGroup extends Model
{
  protected $fillable = [
      's_user_id', 'f_user_id', 'id'
  ];
  public function users()
  {
      return $this->hasMany('App\User');
  }
}
