<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inventory extends Model
{
    protected $fillable = [
    'pname', 'description', 'quantity',
];
}
