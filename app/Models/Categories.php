<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categories extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function publication(): HasMany
    {
        return $this->hasMany(Publication_about_animal::class);
    }
}
