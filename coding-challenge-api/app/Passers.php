<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Passers extends Model
{
    protected $fillable = ['name', 'school', 'division', 'campus'];
}
