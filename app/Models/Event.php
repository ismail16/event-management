<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Event extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $primaryKey = 'id';

    const EVENT_TYPE_PUBLIC = 'public';
    const EVENT_TYPE_PRIVATE = 'private';
    const EVENT_TYPE_MEMBER = 'member';
    const SUBSCRIPTION_FEE_TYPE_FREE = 'free';
    const SUBSCRIPTION_FEE_TYPE_FLAT_PRICE = 'flat_price';
    const SUBSCRIPTION_FEE_TYPE_PACKAGE = 'package';

    protected $fillable = [
        'name',
        'venue',
        'email',
        'phone',
        'event_start_date',
        'event_end_date',
        'reg_start_date',
        'reg_end_date',
        'event_type',
        'subscription_fee_type',
        'subscription_fee',
        'max_participant',
        'is_published',
        'is_registration_allowed',
        'organization',
        'contact',
        'map_url',
        'social_url',
        'faq_url',
        'description',
    ];

    protected $casts = [
        'event_start_date'        => 'datetime',
        'event_end_date'          => 'datetime',
        'reg_start_date'          => 'datetime',
        'reg_end_date'            => 'datetime',
        'is_published'            => 'boolean',
        'is_registration_allowed' => 'boolean',
    ];

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function scopeUpcoming(Builder $builder): Builder
    {
        return $builder
            ->where('is_published', '=', true)
            ->where('is_registration_allowed', '=', false)
            ->where('reg_start_date', '>=', today());
    }

    public function scopeOngoing(Builder $builder): Builder
    {
        return $builder
            ->where('is_published', '=', true)
            ->where('is_registration_allowed', '=', true)
            ->where('reg_start_date', '>=', today());
    }

    public function scopeEnded(Builder $builder): Builder
    {
        return $builder->where('event_end_date', '<', today());
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class, 'event_user', 'event_id', 'user_id'
        )->using(EventUser::class);
    }
}
