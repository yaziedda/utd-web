<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffModel extends Model
{
    protected $table = "staff";
    protected $primaryKey = "id";
    public $timestamps = false;
}
