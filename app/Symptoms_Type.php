<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Symptoms_Type extends Model
{
    //
    protected $table='ms_symptoms_type';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'status'
    ];


}
