<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
        'oauth',
        'oauth_provider',
        'role_id',
        'email_verified_at',
        "account_verified",
        "avatar"
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    // protected $casts = [
    //     'oauth' => 'boolean',
    //     'email_verified' => 'boolean',
    // ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
     // 🔗 Global role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // 🎟 Tickets bought by user
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    // 🧾 Logs created by user
    public function ActivityLogs()
    {
        return $this->hasMany(ActivityLog::class, 'actor_id');
    }

    // 🚨 Reports submitted by user
    public function reports()
    {
        return $this->hasMany(Report::class, 'reporter_id');
    }

    // 👥 Groups user belongs to

    // 👑 Groups user owns
    // public function ownedGroups()
    // {
    //     return $this->hasMany(Group::class, 'owner_id');
    // }

    // 🎉 Events created directly by user
    public function events()
    {
        return $this->hasMany(Event::class, 'created_by');
    }
}
