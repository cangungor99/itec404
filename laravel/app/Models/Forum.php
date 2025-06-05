<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Forum extends Model
{
    protected $primaryKey = 'forumID';
    public $timestamps = false;
    use HasFactory;

    protected $fillable = [
        'clubID',
        'userID',
        'title',
        'description',
        'status',
        'created_at',
    ];
    protected $casts = [
        'created_at' => 'datetime',
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
    public function comments()
    {
        return $this->hasMany(ForumComment::class, 'forumID');
    }
}
