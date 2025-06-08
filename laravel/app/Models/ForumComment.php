<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ForumComment extends Model
{
    protected $primaryKey = 'commentID';
    public $timestamps = false;

    protected $fillable = [
        'forumID',
        'userID',
        'message',
        'created_at',
        'parentID',
        'status'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userID');
    }

    public function forum(): BelongsTo
    {
        return $this->belongsTo(Forum::class, 'forumID');
    }
    public function parent(): BelongsTo
    {
        return $this->belongsTo(ForumComment::class, 'parentID');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(ForumComment::class, 'parentID', 'commentID')
            ->where('status', 'approved')
            ->with('user');
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'commentID');
    }
}
