<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PremiumSubscriptionTouser extends Model
{
    use HasFactory;
    protected $table  = 'tbl_premium_subscription_to_user';
    public $guarded = [];
}
