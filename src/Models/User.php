<?php

namespace QRFeedz\Cube\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_admin' => 'boolean',
        'is_affiliate' => 'boolean',
    ];

    public function affiliate()
    {
        return $this->hasOne(Affiliate::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function authorizations()
    {
        return $this->hasMany(UserAuthorization::class)
                    ->withTimestamps();
    }

    /** ---------------------- BUSINESS METHODS ----------------------------- */

    /**
     * Used to check if a given model instance is authorized in another model
     * in a specific authorization type.
     * Normally used on policies, e.g.:
     * Check if the user has "admin" permissions in a client X.
     */
    public function isAuthorizedAs(Model $model, string $type)
    {
        return $model
                ->authorizationsForUser($this)
                ->get()
                ->pluck('name')
                ->contains($type);
    }

    /**
     * This special query will return if an user has at least a single
     * entry in the authorizables table with a specific authorization
     * type. Useful to discover if, e.g. an user is an "affiliate" somewhere.
     */
    public function isAtLeastAuthorizedAs(string $type)
    {
        // Needs to be obtained via a direct query.
        return DB::table('authorizables')
                 ->where('user_id', $this->id)
                 ->where('authorization_id', Authorization::firstWhere('canonical', $type)->id)
                 ->whereNull('deleted_at')
                 ->count() > 0;
    }
}
