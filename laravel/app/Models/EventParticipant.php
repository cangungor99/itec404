<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventParticipant extends Model
{
    use HasFactory;

    protected $primaryKey = 'participantID';
    public $timestamps = false;

    protected $fillable = [
        'eventID',
        'userID',
        'joined_at',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(ClubEvent::class, 'eventID');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userID');
    }
}
