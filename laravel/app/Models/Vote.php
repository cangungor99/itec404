<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vote extends Model
{
    protected $primaryKey = 'voteID';
    public $timestamps = false;

    protected $fillable = [
        'votingID',
        'userID',
        'optionID',
        'timestamp',
    ];
    public function voting(): BelongsTo
    {
        return $this->belongsTo(Voting::class, 'votingID');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userID');
    }
    public function option(): BelongsTo
    {
        return $this->belongsTo(VotingOption::class, 'optionID');
    }
}
