<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use QRFeedz\Cube\Concerns\Authenticates;

class User extends Authenticatable implements HasLocalePreference
{
    use Authenticates, Notifiable, SoftDeletes;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_super_admin' => 'boolean',
        'is_admin' => 'boolean',
        'is_affiliate' => 'boolean',

        'commission_percentage' => 'integer',
    ];

    public function preferredLocale()
    {
        return $this->locale->canonical;
    }

    /**
     * Source: locales.id
     * Relationship: validated
     * Relationship ID: 27
     */
    public function locale()
    {
        return $this->belongsTo(Locale::class);
    }

    /**
     * Source: clients.id
     * Relationship: validated
     * Relationship ID: 7
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Source: clients.user_affiliate_id
     * Relationship: validated
     * Relationship ID: 1
     */
    public function affiliatedClients()
    {
        return $this->hasMany(Client::class, 'user_affiliate_id');
    }

    /**
     * Source: client_authorizations.user_id
     * Relationship: validated
     * Relationship ID: 33
     */
    public function clientAuthorizations()
    {
        return $this->hasMany(ClientAuthorization::class);
    }

    /**
     * Source: questionnaire_authorizations.user_id
     * Relationship: validated
     * Relationship ID: 32
     */
    public function questionnaireAuthorizations()
    {
        return $this->hasMany(QuestionnaireAuthorization::class);
    }

    /**
     * Source: affiliates.country_id
     * Relationship: validated
     * Relationship ID: 3
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * ---------------------- BUSINESS METHODS -----------------------------
     */

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
    public function isAtLeastAuthorizedAs(string $canonical)
    {
        return
            // authorization canonical is a client authorization.
            $this->clientAuthorizations()
                 ->where(
                     'authorization_id',
                     Authorization::firstWhere('canonical', $canonical)->id
                 )->exists() ||

            // authorization canonical is a questionnaire authorization.
            $this->questionnaireAuthorizations()
                 ->where(
                     'authorization_id',
                     Authorization::firstWhere('canonical', $canonical)->id
                 )->exists();
    }

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
        return
            $this->isSystemAdminLike() ||
            $this->isAffiliate() ||
            $this->clientAuthorizations()->exists() ||
            $this->questionnaireAuthorizations()->exists();
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
        switch (get_class($model)) {
            case 'QRFeedz\Cube\Models\Client':
                $this->clientAuthorizations()
                     ->where(
                         'authorization_id',
                         Authorization::firstWhere('canonical', $canonical)->id
                     )->exists();
                break;

            case 'QRFeedz\Cube\Models\Questionnaire':
                $this->questionnaireAuthorizations()
                     ->where(
                         'authorization_id',
                         Authorization::firstWhere('canonical', $canonical)->id
                     )->exists();
                break;
        }
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
    public function isSystemAdminLike()
    {
        return $this->isSuperAdmin() || $this->isAdmin();
    }

    /**
     * The user is affiliate, meaning has clients as affiliates.
     */
    public function isAffiliate()
    {
        return $this->is_affiliate;
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
