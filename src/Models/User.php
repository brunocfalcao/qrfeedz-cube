<?php

namespace QRFeedz\Cube\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use QRFeedz\Cube\Concerns\ConcernsAuthorizations;

class User extends Authenticatable
{
    use ConcernsAuthorizations, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relationship validated.
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function authorizations()
    {
        return $this->morphToMany(Authorization::class, 'authorizable')
                    ->wherePivot('user_id', $this->id)
                    ->withTimestamps();
    }
}
