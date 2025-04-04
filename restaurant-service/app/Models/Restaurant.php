<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'address',
        'phone',
        'email',
        'logo',
        'is_active',
        'rating'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'rating' => 'decimal:2'
    ];

    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class);
    }
}
