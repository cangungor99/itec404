<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Voting extends Model
{
    protected $primaryKey = 'votingID';
    public $timestamps = true;
    use HasFactory;

    protected $fillable = [
        'clubID',
        'title',
        'description',
        'start_date',
        'end_date',
    ];
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function club(): BelongsTo{
        return $this->belongsTo(Club::class, 'clubID');
    }

    public function options(): HasMany
    {
        return $this->hasMany(VotingOption::class, 'votingID');
    }

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class, 'votingID');
    }
}
