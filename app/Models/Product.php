<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'image_path',
        'name',
        'price',
        'quantity',
        'description',
        'category_id'
    ];
    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function isSelectedCategory(int $category_id): bool
    {
        return $this->hasCategory() && $this->category->id == $category_id;
    }
    public function hasCategory(): bool{
        return !is_null($this->category);
    }
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }
}

