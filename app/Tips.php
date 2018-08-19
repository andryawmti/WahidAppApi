<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tips extends Model
{
    protected $table = 'tips';

    public function getTips()
    {
        $tips = DB::select("SELECT t.*, CONCAT(a.first_name,' ',a.last_name) as author_name FROM `tips` as t
                LEFT JOIN `admins` as a ON t.admin_id = a.id");
        return $tips;
    }
}
