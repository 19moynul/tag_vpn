<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceToUser extends Model
{
    use HasFactory;
    protected $table = 'tbl_user_to_device';
    public $guarded = [];

}
