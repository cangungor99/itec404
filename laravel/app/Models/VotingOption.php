<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class VotingOption extends Model
{
    protected $primaryKey = 'optionID';
    public $timestamps = false;
    use HasFactory;

    protected $fillable = [
        'votingID',
        'option_text',
    ];

    public function voting(): BelongsTo
    {
        return $this->belongsTo(Voting::class, 'votingID');
    }
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class, 'optionID');
    }
}
