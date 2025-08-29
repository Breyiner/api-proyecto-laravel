<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Goal extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'target_amount',
        'description',
        'due_date',
        'completed',
        'status_id',
    ];

    protected $casts = [
        'due_date' => 'datetime:Y-m-d',
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
        'target_amount' => 'integer',
    ];

    /**
     * Get the user that owns the goal.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(GoalStatus::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(GoalTransaction::class);
    }

    public function progress(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->transactions->sum(
                fn ($transaction) => $transaction->transaction_type_id == 1
                    ? $transaction->amount
                    : -$transaction->amount
            )
        );
    }  
    
    public function getTotalTransactionsAttribute()
    {
        return $this->transactions()->count();
    }
}
