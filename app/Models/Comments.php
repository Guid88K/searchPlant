<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comments extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function publication(): BelongsTo
    {
        return $this->belongsTo(Publication_about_animal::class);
    }
}
