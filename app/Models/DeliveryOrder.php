<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeliveryOrder extends Model
{
    protected $fillable = ['do_number', 'recipient_name', 'recipient_phone', 'delivery_address', 'status', 'driver_id', 'fleet_id', 'scheduled_delivery', 'actual_delivery', 'notes'];

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    public function fleet(): BelongsTo
    {
        return $this->belongsTo(Fleet::class);
    }
}
