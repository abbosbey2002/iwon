<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'language_code', 'text'];

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_code', 'code');
    }
}
