<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChatSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_id',
        'context',
        'user_preferences',
        'recommended_school',
        'school_scores',
        'completed',
        'completed_at'
    ];

    protected function casts(): array
    {
        return [
            'context' => 'array',
            'user_preferences' => 'array',
            'school_scores' => 'array',
            'completed' => 'boolean',
            'completed_at' => 'datetime'
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(ChatMessage::class)->orderBy('created_at');
    }

    public function latestMessages(): HasMany
    {
        return $this->hasMany(ChatMessage::class)->orderBy('created_at', 'desc')->limit(10);
    }
}