<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payment extends Model
{
    use HasFactory;

    const STATUS_PAID = 'Paid';
    const STATUS_FAILED = 'Failed';
    const STATUS_PENDING = 'Pending';
    const STATUS_PROCESSING = 'Processing';
    const STATUS_REFUND = 'Refund';
    const STATUS_EXTRA_AMOUNT = 'ExtraAmount';
    const STATUS_MANUAL = 'Manual';

    protected $fillable = [
        'amount', 'quantity', 'event_id', 'invoice_id', 'status'
    ];

    protected $casts = [
        'paid_at' => 'datetime',
    ];

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function payments_log(): HasMany
    {
        return $this->hasMany(PaymentLog::class);
    }
}
