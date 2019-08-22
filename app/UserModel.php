<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = "anggota";
    protected $primaryKey = "id";
    public $timestamps = false;
}
