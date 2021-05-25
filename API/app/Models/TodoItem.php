<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TodoItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'user_id',
        'date',
        'pinned',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function memo(): HasOne
    {
        return $this->hasOne(Memo::class);
    }
}
