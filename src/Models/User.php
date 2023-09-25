<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use QRFeedz\Cube\Concerns\Authenticates;
use QRFeedz\Cube\Concerns\HasAuthorizations;

class User extends Authenticatable implements HasLocalePreference
{
    use Authenticates, HasAuthorizations, Notifiable, SoftDeletes;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_super_admin' => 'boolean',

        'commission_percentage' => 'integer',
    ];

    public function preferredLocale()
    {
        return $this->locale->canonical;
    }

    /**
     * Related locale, used on the preferredLocale() method for automated
     * locale identification for mailables.
     *
     * Source: locales.id
     * Relationship: validated
     */
    public function locale()
    {
        return $this->belongsTo(Locale::class);
    }

    /**
     * Related client where this user belongs to. This is not related with
     * the affiliate logic (one user can have many client as affiliate).
     *
     * Source: clients.id
     * Relationship: validated
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * These are the clients that an affiliate has.
     *
     * Source: clients.user_affiliate_id
     * Relationship: validated
     */
    public function affiliatedClients()
    {
        return $this->hasMany(Client::class, 'user_affiliate_id');
    }

    /**
     * This special query will return if an user has at least a single
     * entry in the authorizables table with a specific authorization
     * type. As example, if we want to know if an user is "at least"
     * client-admin somewhere, then we call it
     * isAtLeastAuthorizedAs('client-admin').
     *
     * @param  string  $type Authorization canonical
     * @return bool
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

    public function authorizationsAs(string $type)
    {
        return DB::table('authorizables')
                 ->where('user_id', $this->id)
                 ->where('authorization_id', Authorization::firstWhere('canonical', $type)->id)
                 ->whereNull('deleted_at')
                 ->get();
    }

    /**
     * The related country from the affiliate address.
     *
     * Source: affiliates.country_id
     * Relationship: validated
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * ---------------------- BUSINESS METHODS -----------------------------
     */
    /**
     * Returns if an user is:
     *     - Admin-like or
     *     - Affiliate or
     *     - <business>-admin (client-, questionnaire-, gdpr, etc).
     *
     * @return bool
     */
    public function isAllowedAdminAccess()
    {
        return $this->isAdminLike() ||
               $this->isAffiliate() ||
               $this->isAtLeastAuthorizedAs('client-admin') ||
               $this->isAtLeastAuthorizedAs('location-admin') ||
               $this->isAtLeastAuthorizedAs('questionnaire-admin');
    }

    /**
     * Used to check if a given model instance is authorized in another model
     * in a specific authorization type.
     * Normally used on policies, e.g.:
     * Check if the user has "admin" ($type) permissions in a client X ($model).
     *
     * @param  Model  $model|null
     * @return bool
     */
    public function isAuthorizedAs(Model $model = null, string $type)
    {
        $authorizationId = Authorization::firstWhere('canonical', $type)->id;

        if (! $authorizationId || ! $model) {
            return false;
        }

        /**
         * An user itself is not connected to authorizations because
         * the user_id is a pivot column. So, we need to use a DB
         * query for that. On this case, because it's a test we
         * just make a simple sql query comparison
         */
        $className = get_class($model);

        return DB::table('authorizables')
                 ->where('authorization_id', $authorizationId)
                 ->where('user_id', $this->id)
                 ->where('model_id', $model->id)
                 ->where('model_type', $className)
                 ->count() > 0;
    }

    /**
     * The user is admin. Kind'of super admin but with less authorization.
     */
    public function isAdmin()
    {
        return $this->is_admin;
    }

    /**
     * The user is super admin. All previleges are given.
     */
    public function isSuperAdmin()
    {
        return $this->is_super_admin;
    }

    /**
     * If an user is super admin, or system admin.
     *
     * @return bool
     */
    public function isAdminLike()
    {
        return $this->isSuperAdmin() || $this->isAdmin();
    }

    /**
     * The user is affiliate, meaning has clients as affiliates.
     */
    public function isAffiliate()
    {
        return $this->affiliatedClients()
                    // Even the ones that were already deleted.
                    ->withTrashed()
                    ->count() > 0;
    }

    public function isAffiliateOf(Client $client = null)
    {
        if (! $client) {
            return false;
        }

        return $client->where('user_affiliate_id', $this->id)->exists();
    }

    /** ------------------------ LOCAL SCOPES ------------------------------- */
    public function scopeAsAffiliate(Builder $query)
    {
        return $query->where('commission_percentage', '>', 0);
    }

    /** ---------------------- DEFAULT VALUES ------------------------------- */
    // Fallback to client locale, or lastly to english.
    public function defaultLocaleIdAttribute()
    {
        if ($this->client) {
            return $this->client->locale_id;
        } else {
            return Locale::firstWhere('canonical', 'en')->id;
        }
    }
}
