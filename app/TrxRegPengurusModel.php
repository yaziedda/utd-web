<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrxRegPengurusModel extends Model
{
    protected $table = "trx_reg_pengurus";
    protected $primaryKey = "id";
    public $timestamps = false;
}
