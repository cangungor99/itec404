<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Notification extends Model
{
    protected $primaryKey = 'notificationID';
    public $timestamps = true;
    use HasFactory;

    protected $fillable = [
        'creatorID',
        'clubID',
        'title',
        'content',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creatorID');
    }

    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class, 'clubID');
    }
    public function readers()
    {
        return $this->belongsToMany(User::class, 'notification_user', 'notificationID', 'userID')
            ->withPivot('is_read')
            ->withTimestamps();
    }
}
