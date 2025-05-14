<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Vote extends Model
{
    protected $primaryKey = 'voteID';
    public $timestamps = false;
    use HasFactory;

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
