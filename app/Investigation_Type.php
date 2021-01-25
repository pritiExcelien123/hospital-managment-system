<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investigation_Type extends Model
{
    //
    protected $table='ms_investigation_type';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'status'
    ];


}
