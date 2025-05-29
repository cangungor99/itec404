<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Chat extends Model
{
    protected $primaryKey = 'chatID';
    public $timestamps = false;
    use HasFactory;

    protected $fillable = [
        'clubID',
        'senderID',
        'receiverID',
        'message',
        'created_at',
        'isRead',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
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
