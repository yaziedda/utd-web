<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MsProductModel extends Model
{
    protected $table = "ms_product";
    protected $primaryKey = "id";
    public $timestamps = false;
}
