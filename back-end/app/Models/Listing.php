<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Listing extends Model
{
    use HasFactory;

    protected $casts = [
        'amenity_wifi' => 'boolean',
        'amenity_pets' => 'boolean',
        'amenity_tv' => 'boolean',
        'amenity_kitchen' => 'boolean',
        'amenity_breakfast' => 'boolean',
        'amenity_laptop' => 'boolean',
        'amenity_air_conditioning' => 'boolean',
    ];

    public function scopeFilter($query,array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('title' , 'like', '%' . $filters['search']. '%')
            ->where('address', 'like', '%' . $filters['search'] . '%')
            ->where('description', 'like', '%' . $filters['search'] . '%')
            ->where('price_per_night', 'like', '%' .$filters['search'] . '%');
        }
    }
}
