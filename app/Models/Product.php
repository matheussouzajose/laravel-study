<?php

namespace App\Models;

use App\Events\StockEntryCreated;
use App\Tenant\TenantModels;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory, TenantModels, Searchable;

    const STOCK_MAX = 1000;

    protected $dispatchesEvents = [
        'saved' => StockEntryCreated::class
    ];

    /** @var string[] */
    protected $fillable = ['name', 'slug', 'cover', 'price', 'description', 'stock', 'category_id', 'company_id'];

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return string
     */
    public function getPriceFormattedAttribute(): string
    {
        return "R$ " . number_format($this->attributes['price'], 2, ",", ".");
    }
}
