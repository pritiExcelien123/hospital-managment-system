<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diagnosis_Type extends Model
{
    //
    protected $table='ms_diagnosis_type';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','parent_id','name', 'status'
    ];


}
