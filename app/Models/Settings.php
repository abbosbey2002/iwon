<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $fillable = ['site_logo', 'customer_logo', 'google_play_link', 'app_store_link', 'google_play_image', 'app_store_image', 'expired_date'];
}
