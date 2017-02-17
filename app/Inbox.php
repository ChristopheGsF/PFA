<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
  protected $fillable = [
      'content', 'user_id', 'hash_id'
  ];
}
