<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Patients_Record extends Model
{
    protected $table = 'patients_record';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','symptom_id','arrival_id', 'temprature','rr','pulse_rate','crt','bp','spo2','weight','ht_lt','mu_ac','weight_legnth','systemic_examination','treatment_info','diagnosis_info','date','report','investigation_id'
    ];
}
