<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Illness_Arrival_Type extends Model
{
    //
    protected $table='ms_illness_arrival_type';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'status'
    ];


}
