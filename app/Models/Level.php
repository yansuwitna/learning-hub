<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Level extends Model
{
    protected $fillable = ['level_number', 'title', 'subtitle', 'min_xp', 'icon', 'description'];

    public function missions(): HasMany
    {
        return $this->hasMany(Mission::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function materials(): HasMany
    {
        return $this->hasMany(Material::class);
    }
}
