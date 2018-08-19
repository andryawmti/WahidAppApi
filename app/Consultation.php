<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Consultation extends Model
{
    protected $table = "consultation";

    public function getConsultations()
    {
        $consultations = DB::select("SELECT c.id, c.user_id, c.weight, c.sleep_time, 
        c.activity, c.calorie, c.pregnancy_age, DATE_FORMAT(c.created_at, '%d-%m-%y') as created_at
         , DATE_FORMAT(c.updated_at, '%d-%m-%y') as updated_at FROM `consultation` as c");
        return $consultations;
    }

    public function getUserConsultations()
    {
        $consultations = DB::select("SELECT c.id, c.user_id, c.weight, c.sleep_time, 
        c.activity, c.calorie, c.pregnancy_age, DATE_FORMAT(c.created_at, '%d-%m-%y') as created_at
         , DATE_FORMAT(c.updated_at, '%d-%m-%y') as updated_at FROM `consultation` as c");
        return $consultations;
    }
}
