<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Attachment extends Model
{
    protected $primaryKey = 'attachmentID';
    public $timestamps = false;
    use HasFactory;

    protected $fillable = [
        'resourceID',
        'forumID',
        'commentID',
        'userID',
        'file_path',
        'file_type',
        'uploaded_at',
    ];
    public function resource(): BelongsTo
    {
        return $this->belongsTo(Resource::class, 'resourceID');
    }
    public function forum(): BelongsTo
    {
        return $this->belongsTo(Forum::class, 'forumID');
    }
    public function comment(): BelongsTo
    {
        return $this->belongsTo(ForumComment::class, 'commentID');
    }
}
