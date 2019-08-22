<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrxProductPengurusModel extends Model
{
    protected $table = "trx_product_pengurus";
    protected $primaryKey = "id";
    public $timestamps = false;
}
