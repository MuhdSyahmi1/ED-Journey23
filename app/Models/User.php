<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',           // NEW: For active/inactive status
        'manager_type',     // NEW: For manager role types
        'last_login_at',    // NEW: Track last login
        'created_by',       // NEW: Track who created this user
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at' => 'datetime',      // NEW: Cast to datetime
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    // EXISTING ROLE METHODS
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isStaff(): bool
    {
        return $this->role === 'staff';
    }

    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    // NEW: Status Methods
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isInactive(): bool
    {
        return $this->status === 'inactive';
    }

    // NEW: Manager Type Methods
    public function isProgramManager(): bool
    {
        return $this->manager_type === 'program';
    }

    public function isAdmissionManager(): bool
    {
        return $this->manager_type === 'admission';
    }

    public function isNewsEventsManager(): bool
    {
        return $this->manager_type === 'news_events';
    }

    public function isModerator(): bool
    {
        return $this->manager_type === 'moderators';
    }

    public function isDataAnalyticsManager(): bool
    {
        return $this->manager_type === 'data_analytics';
    }

    public function getManagerTypeDisplayAttribute(): string
    {
        return match($this->manager_type) {
            'program' => 'Program Manager',
            'admission' => 'Admission Manager',
            'news_events' => 'News & Events Manager',
            'moderators' => 'Moderator',
            'data_analytics' => 'Data & Analytics Manager',
            default => 'Manager',
        };
    }

    // NEW: Status Badge Color for UI
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'active' => 'bg-green-100 text-green-800',
            'inactive' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    // NEW: Relationships for Feedback System
    public function feedback(): HasMany
    {
        return $this->hasMany(Feedback::class);
    }

    public function feedbackReplies(): HasMany
    {
        return $this->hasMany(Feedback::class, 'replied_by');
    }

    // NEW: Relationships for Manager Creation Tracking
    public function createdManagers(): HasMany
    {
        return $this->hasMany(User::class, 'created_by');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // NEW: User Profile Relationship
    public function userProfile(): HasOne
    {
        return $this->hasOne(UserProfile::class);
    }

    // NEW: Case Report Relationship
    public function caseReport(): HasOne
    {
        return $this->hasOne(CaseReport::class);
    }

    // NEW: Query Scopes for Easy Filtering
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    public function scopeStaff($query)
    {
        return $query->where('role', 'staff');
    }

    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    public function scopeRegularUsers($query)
    {
        return $query->where('role', 'user');
    }

    public function scopeProgramManagers($query)
    {
        return $query->where('manager_type', 'program');
    }

    public function scopeAdmissionManagers($query)
    {
        return $query->where('manager_type', 'admission');
    }

    public function scopeNewsEventsManagers($query)
    {
        return $query->where('manager_type', 'news_events');
    }

    public function scopeModerators($query)
    {
        return $query->where('manager_type', 'moderators');
    }

    public function scopeDataAnalyticsManagers($query)
    {
        return $query->where('manager_type', 'data_analytics');
    }
}