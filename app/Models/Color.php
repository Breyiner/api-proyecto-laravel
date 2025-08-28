<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Color extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'hex',
    ];

    /**
     * Get the goal transaction types associated with the color.
     */
    public function goalTransacTypes(): HasMany
    {
        return $this->hasMany(GoalTransactionType::class);
    }

    /**
     * Get the transaction types associated with the color.
     */
    public function TransacTypes(): HasMany
    {
        return $this->hasMany(TransactionType::class);
    }
}
