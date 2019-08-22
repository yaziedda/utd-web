<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MsDokumentModel extends Model
{
    protected $table = "ms_dokument";
    protected $primaryKey = "id";
    public $timestamps = false;
}
