<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Empolyee;
use App\Models\Photo;
class Company extends Model
{
  use HasFactory;
  protected $fillable = [
    'name',
    'wepsite',
    'email',
    'status',
  ];

  public function employees() {
    return $this->hasMany(Empolyee::class);
  }

  public function logo()
  {
    return $this->morphOne('App\Models\Photo', 'photoable');
  }
}
