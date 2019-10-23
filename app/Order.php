<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $fillable = [
    'amount', 'transaction-id', 'status', 'currency'
];
}
