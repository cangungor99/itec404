<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClubEvent extends Model
{
    use HasFactory;

    protected $primaryKey = 'eventID';
    public $timestamps = false;

    protected $fillable = [
        'clubID',
        'title',
        'description',
        'location',
        'start_time',
        'end_time',
        'created_at',
    ];

    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class, 'clubID');
    }
    public function participants()
    {
        return $this->hasMany(EventParticipant::class, 'eventID');
    }
}
