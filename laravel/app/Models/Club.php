<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Club extends Model
{
    protected $primaryKey = 'clubID';
    public $timestamps = false;

    protected $fillable = [
        'managerID',
        'leaderID',
        'name',
        'photo',
        'description',
        'status',
        'created_at',
    ];

    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'managerID');
    }

    public function leader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'leaderID');
    }
    public function memberships(): HasMany
    {
        return $this->hasMany(Membership::class, 'clubID');
    }
    public function resources(): HasMany
    {
        return $this->hasMany(Resource::class, 'clubID');
    }
    public function forums(): HasMany
    {
        return $this->hasMany(Forum::class, 'clubID');
    }
    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class, 'clubID');
    }
    public function chats(): HasMany
    {
        return $this->hasMany(Chat::class, 'clubID');
    }
    public function votings()
    {
        return $this->hasMany(Voting::class, 'clubID');
    }
}
