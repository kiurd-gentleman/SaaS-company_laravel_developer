<?php

namespace App\Models;

use App\Models\Scopes\InventoryScope;
use App\Traits\ModelAttributeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory , ModelAttributeTrait;

    protected $fillable = [
        'title',
        'description',
        'user_id',
    ];

    public function inventoryItems()
    {
        return $this->hasMany(InventoryItem::class);
    }

    protected static function boot()
    {
        parent::boot();
        self::bootCreatedUpdatedBy();
    }

    protected static function booted()
    {
        static::addGlobalScope(new InventoryScope);
    }
}
