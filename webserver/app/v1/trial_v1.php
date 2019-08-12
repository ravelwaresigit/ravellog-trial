<?php

namespace App\v1;

use Illuminate\Database\Eloquent\Model;

class trial_v1 extends Model
{
    protected $table = 'trial_v1';
    protected $primaryKey = 'id';

    protected $fillable = [
        'trial_number'
    ];
}
