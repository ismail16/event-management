<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventUser extends Pivot
{
    use HasFactory;

    protected $primaryKey = '_id';

    protected $fillable = [
        '_id',
        'event_id',
        'user_id',
        'role',
    ];

    public function getKeyName(): string
    {
        return '_id';
    }
}
