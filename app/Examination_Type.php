<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Examination_Type extends Model
{
    //
    protected $table='ms_examination_type';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','parent_id','ex_type','name', 'status'
    ];


}
