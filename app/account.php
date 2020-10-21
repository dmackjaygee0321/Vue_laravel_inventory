<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class account extends Model
{
    protected $fillable = [
    'email', 'uname', 'password',
];
}
