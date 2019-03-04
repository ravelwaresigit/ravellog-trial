<?php

namespace App\v2;

use Illuminate\Database\Eloquent\Model;

class tag_v2 extends Model
{
    protected $table = 'tag_v2';
     protected $primaryKey = 'id';
    protected $fillable = [
        'x','y','z', 'epc', 'trial_number'
    ];
    
    public $timestamps = false;
}
