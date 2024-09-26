<?php

namespace App\Models;

use App\Filters\Filterable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Filterable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'status',
        'roles',
        'phone',
        'organization',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'roles'             => 'array',
    ];

    public function getFullNameAttribute(): string
    {
        return sprintf("%s %s", $this->first_name, $this->last_name);
    }

    public function getNamePhoneAttribute(): string
    {
        return $this->getFullNameAttribute().' - '.$this->phone;
    }

    public function verificationCodes(): HasMany
    {
        return $this->hasMany(VerificationCode::class);
    }

    public function memberOf(): BelongsToMany
    {
        return $this->belongsToMany(
            Event::class, 'event_user', 'user_id', 'event_id'
        )->using(EventUser::class)->withPivot('role');
    }
}
