<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Consultation extends Model
{
    protected $table = "consultations";

    public function getConsultations()
    {
        $consultations = DB::select("SELECT c.*, m.title as menu_title, u.first_name, u.last_name FROM `consultations` as c
            LEFT JOIN menus as m ON c.menu_id = m.id
            LEFT JOIN users as u ON c.user_id = u.id
            ORDER BY created_at DESC");
        return $consultations;
    }
}
