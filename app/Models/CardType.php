<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CardType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo_path',
    ];

    public function bankAccounts(): HasMany
    {
        return $this->hasMany(BankAccount::class);
    }
}
