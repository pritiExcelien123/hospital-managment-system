<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treatment_Type extends Model
{
    //
    protected $table='ms_treatment_type';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name','type', 'status'
    ];


}
