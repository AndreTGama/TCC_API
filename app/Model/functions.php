<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class functions extends Model
{
    protected $table = 'functions';

    protected $fillable = [
       'function',
    ];
}