<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BankAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_id',
        'card_type_id',
        'currency_id',
        'account_number',
        'sort_code',
    ];

    protected $appends = ['is_main'];

    public function isMain(): Attribute
    {
        return Attribute::make(
            get: function() {
                return $this->users()
                    ->wherePivot('is_main', true)->exists();
            }
        );
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }

    public function cardType(): BelongsTo
    {
        return $this->belongsTo(CardType::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_bank_account');
    }

    public function scopeMain($query)
    {
        return $query->whereHas('users', function ($query) {
            $query->wherePivot('is_main', true);
        });
    }
}
