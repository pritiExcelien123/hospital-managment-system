<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Round_Shift extends Model
{
    //
    protected $table='ms_round_shift';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'status'
    ];


}
