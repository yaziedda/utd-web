<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MsNewsModel extends Model
{
    protected $table = "ms_news";
    protected $primaryKey = "id";
    public $timestamps = false;
}
