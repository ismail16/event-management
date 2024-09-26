<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use  Illuminate\Database\Eloquent\Factories\HasFactory;

class Registration extends Model
{
    use HasFactory;

    const MARITAL_STATUS_SINGLE = 'single';
    const MARITAL_STATUS_MARRIED = 'married';

    const TYPE_GUEST_COUPLE = 'couple';
    const TYPE_GUEST_KID_ABOVE = 'kidAbove';
    const TYPE_GUEST_KID_BELOW = 'kidBelow';
    const TYPE_GUEST_DRIVER = 'driver';
    const TYPE_GUEST_MAID = 'maid';
    const TYPE_GUEST_OTHER = 'other';
    const TYPE_GUEST_SINGLE = 'single';
    const TYPE_GUEST_GENERAL = 'general';
    const TYPE_GUEST_STUDENT = 'student';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'batch',
        'cadet_number',
        'address',
        'house',
        'marital_status',
        'tshirt_size'
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function payment(): hasOne

    {
        return $this->hasOne(Payment::class);
    }

    public function guests(): HasMany
    {
        return $this->hasMany(Guest::class);
    }
}
