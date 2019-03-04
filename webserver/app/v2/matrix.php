<?php

namespace App\v2;

use Illuminate\Database\Eloquent\Model;

class matrix extends Model
{
    protected $table = 'matrix';
    protected $primaryKey = 'id';

    protected $fillable = [
        'x','y','z'
    ];
}
