<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, UuidTrait;

    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'is_active',
        'name',
        'price',
        'description',
        'image',
        'weight',
        'min_weight',
        'country_origin',
        'quality',
        'check',
        'category_id',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'price' => 'double',
            'weight' => 'double',
            'min_weight' => 'double',
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
