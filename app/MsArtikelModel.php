<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MsArtikelModel extends Model
{
    protected $table = "ms_artikel";
    protected $primaryKey = "id";
    public $timestamps = false;
}
