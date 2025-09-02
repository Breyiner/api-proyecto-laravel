<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class GoalTransactionType extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'color_id',
        'icon_id'
    ];

    /**
     * Get the color that owns the goal transaction type.
     */
    public function color(): BelongsTo {

        return $this->belongsTo(Color::class);

    }

    public function transactions(): HasMany
    {
        return $this->hasMany(GoalTransaction::class);
    }
}
