<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monitoring_Type extends Model
{
    //
    protected $table='ms_monitoring_type';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'status'
    ];


}
