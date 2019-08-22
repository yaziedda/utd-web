<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MsConfigModel extends Model
{
    protected $table = "ms_config";
    protected $primaryKey = "id";
    public $timestamps = false;
}
