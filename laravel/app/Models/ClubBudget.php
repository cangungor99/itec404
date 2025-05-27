<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClubBudget extends Model
{
    use HasFactory;

    protected $primaryKey = 'budgetID';

    protected $fillable = [
        'clubID',
        'total_budget',
        'budget_left',
    ];

    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class, 'clubID');
    }
}
