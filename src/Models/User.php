<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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
     *     - Super admin or
     *     - Affiliate or
     *     - <business>-admin (client-, questionnaire-, gdpr, etc).
     *
     * @return bool
     */
    public function isAllowedAdminAccess()
    {
        return $this->isSuperAdmin() ||
               $this->isAffiliate() ||
               $this->isAtLeastAuthorizedAs('client-admin') ||
               $this->isAtLeastAuthorizedAs('questionnaire-admin') ||
               $this->isAtLeastAuthorizedAs('gdpr');
    }

    /**
     * Used to check if a given model instance is authorized in another model
     * in a specific authorization type.
     * Normally used on policies, e.g.:
     * Check if the user has "admin" ($type) permissions in a client X ($model).
     *
     * @param  Model  $model|null [description]
     * @param  string  $type      [description]
     * @return bool               [description]
     */
    public function isAuthorizedAs(Model $model = null, string $type)
    {
        if (! $model) {
            return false;
        }

        return $model
            ->authorizationsForUser($this)
            ->get()
            ->pluck('name')
            ->contains($type);
    }

    public function isSuperAdmin()
    {
        return $this->is_super_admin;
    }

    public function isAffiliate()
    {
        // Well, I could have used a "is_affiliate" but at the end this is okay.
        return $this->commission_percentage > 0;
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
