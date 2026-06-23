<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = ['fleet_id', 'name', 'phone', 'license_number', 'license_expiry', 'status', 'rating', 'notes'];


    public function fleet(): BelongsTo
    {
        return $this->belongsTo(Fleet::class);
    }

    public function deliveryOrders(): HasMany
    {
        return $this->hasMany(DeliveryOrder::class);
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
