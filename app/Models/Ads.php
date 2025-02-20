<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory;

    protected $table = 'ads';

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'desktop', 'mobile', 'video', 'status', 'date_end', 'date_start', 'lang',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'desktop' => 'string',
        'mobile' => 'string',
        'video' => 'string',
        'status' => 'integer',
    ];

    public function getName(): string
    {
        return (string) $this->name;
    }

    public function getStatus(): int
    {
        return (int) $this->status;
    }

    public function getBgDesktop(): string
    {
        return (string) $this->desktop;
    }

    public function getBgMobile(): string
    {
        return (string) $this->mobile;
    }

    public function getVideo(): string
    {
        return (string) $this->video;
    }
}
