<?php

namespace App\v2;

use Illuminate\Database\Eloquent\Model;

class read_logs_v2 extends Model
{
    protected $table = 'read_logs_v2';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id', 'created_at', 'id_atag_v2', 'epc', 'trial_number'
    ];
    public $timestamps = false;
}
