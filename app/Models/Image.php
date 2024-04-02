<?php

namespace App\Models;

use App\Traits\ModelAttributeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory, ModelAttributeTrait;

    protected $fillable = [
        'imageable_id',
        'imageable_type',
        'path',
    ];

    protected static function boot()
    {
        parent::boot();
        self::bootCreatedUpdatedBy();
    }
}
