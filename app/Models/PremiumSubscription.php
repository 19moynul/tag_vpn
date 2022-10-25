<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PremiumSubscription extends Model
{
    use HasFactory;
    public $table = 'tbl_premium_subscription';
    public $guarded = [];
}
