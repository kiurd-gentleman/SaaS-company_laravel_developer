<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'inventory_id',
        'quantity',
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
