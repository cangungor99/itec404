<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Forum extends Model
{
    protected $primaryKey = 'forumID';
    public $timestamps = false;

    protected $fillable = [
        'clubID',
        'userID',
        'title',
        'description',
        'created_at',
    ];

    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class, 'clubID');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userID');
    }
    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'forumID');
    }
}
