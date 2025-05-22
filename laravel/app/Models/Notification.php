<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Notification extends Model
{
    protected $primaryKey = 'notificationID';
    public $timestamps = false;
    use HasFactory;

    protected $fillable = [
        'creatorID',
        'clubID',
        'title',
        'content',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
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
