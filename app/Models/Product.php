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
        'name',
        'price',
        'description',
        'image',
        'weight',
        'min_weight',
        'country_origin',
        'quality',
        'check',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'price' => 'double',
            'weight' => 'double',
            'min_weight' => 'double',
        ];
    }
}
