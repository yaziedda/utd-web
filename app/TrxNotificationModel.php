<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrxNotificationModel extends Model
{
    protected $table = "trx_notification";
    protected $primaryKey = "id";
    public $timestamps = false;
}
