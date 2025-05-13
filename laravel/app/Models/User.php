<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $primaryKey = 'userID';
    public $incrementing = true;
    protected $keyType = 'int';


    protected $fillable = [
        'std_no',
        'name',
        'surname',
        'email',
        'password',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function memberships()
    {
        return $this->hasMany(Membership::class, 'userID');
    }
    public function manageClubs()
    {
        return $this->hasMany(Club::class, 'managerID');
    }
    public function leadClubs()
    {
        return $this->hasMany(Club::class, 'leaderID');
    }
    public function forums()
    {
        return $this->hasMany(Forum::class, 'userID');
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class, 'creatorID');
    }
    public function chatsSent()
    {
        return $this->hasMany(Chat::class, 'senderID');
    }
    public function chatsReceived()
    {
        return $this->hasMany(Chat::class, 'receiverID');
    }
    public function votes()
    {
        return $this->hasMany(Vote::class, 'userID');
    }
}
