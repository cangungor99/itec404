<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chat extends Model
{
    protected $primaryKey = 'chatID';
    public $timestamps = false;

    protected $fillable = [
        'clubID',
        'senderID',
        'receiverID',
        'message',
        'timestamp',
        'is_read',
    ];
    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class, 'clubID');
    }
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'senderID');
    }
    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiverID');
    }
}
