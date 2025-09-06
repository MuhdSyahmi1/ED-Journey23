<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ic_file_path',
        'ic_file_name',
        'name',
        'identity_card',
        'id_color',
        'postal_address',
        'date_of_birth',
        'place_of_birth',
        'gender',
        'telephone_home',
        'mobile_phone',
        'email_address',
        'religion',
        'nationality',
        'race',
        'health_record',
        'verification_status',
        'rejection_reason',
        'hecas_id'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Helper methods
    public function getPhoneNumberAttribute(): ?string
    {
        return $this->mobile_phone ?: $this->telephone_home;
    }

    public function getIcPassportNumberAttribute(): ?string
    {
        return $this->identity_card;
    }

    public function getFullNameAttribute(): string
    {
        return $this->name;
    }

    public function getVerificationStatusTextAttribute(): string
    {
        return match($this->verification_status) {
            'verified' => 'Verified',
            'pending' => 'Pending Verification',
            'rejected' => 'Rejected',
            default => 'Unverified'
        };
    }

    public function getVerificationStatusColorAttribute(): string
    {
        return match($this->verification_status) {
            'verified' => 'green',
            'pending' => 'yellow',
            'rejected' => 'red',
            default => 'gray'
        };
    }
}