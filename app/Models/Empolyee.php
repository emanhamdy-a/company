<?php

namespace App\Models;
use App\Models\Company;
use App\Models\Photo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empolyee extends Model
{
  use HasFactory;
   /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'first_name',
    'last_name',
    'email',
    'phone',
    'company_id',
    'status',
  ];

  public function company() {
    return $this->belongsTo(Company::class);
  }

  public function photo()
  {
    return $this->morphOne('App\Models\Photo', 'photoable');
  }

}
