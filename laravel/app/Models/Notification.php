<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    protected $primaryKey = 'notificationID';
    public $timestamps = false;

    protected $fillable = [
        'creatorID',
        'clubID',
        'title',
        'content',
        'created_at',
    ];
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creatorID');
    }

    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class, 'clubID');
    }
}
