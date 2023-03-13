<?php

namespace QRFeedz\Cube\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
    ];

    // Relationship validated.
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Used to check if a given model instance is authorized in another model
     * in a specific authorization type.
     * Normally used on policies, e.g.:
     * Check if the user has "admin" permissions in a client X.
     *
     * @param  Model  $model  [description]
     * @param  string  $type  [description]
     * @return bool           [description]
     */
    public function isAuthorizedAs(Model $model, string $type)
    {
        return $model
                ->authorizationsForUser($this)
                ->get()
                ->pluck('name')
                ->contains($type);
    }
}
