<?php

namespace QRFeedz\Cube\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use QRFeedz\Authorization\Concerns\ConcernsAuthorizations;

class User extends Authenticatable
{
    use ConcernsAuthorizations, HasFactory, Notifiable, SoftDeletes;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean'
    ];

    // Relationship validated.
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
