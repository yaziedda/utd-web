<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MsHeadlineModel extends Model
{
    protected $table = "ms_headline";
    protected $primaryKey = "id";
    public $timestamps = false;
}
