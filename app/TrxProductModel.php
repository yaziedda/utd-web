<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrxProductModel extends Model
{
    protected $table = "trx_product";
    protected $primaryKey = "id";
    public $timestamps = false;
}
