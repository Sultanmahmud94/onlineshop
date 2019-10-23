<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  //protected $primaryKey = 'cat_id';
  protected $fillable = [
    'title'
  ];

  public $timestamps = false;

  public function products()
    {
        return $this->hasMany(Product::class);
    }
}
