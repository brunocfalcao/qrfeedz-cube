<?php

namespace QRFeedz\Cube\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use QRFeedz\Foundation\Abstracts\QRFeedzModel;

/**
 * This is a special model since it's connected to the authorizables table.
 * It's the way to have an option to manage the user authorizations via a
 * relationship between User and UserAuthorization (this model). Because
 * in Laravel Nova, that's the only way to see data from a polymorphic
 * N-N when you need to affect a pivot column (user_id) on this case.
 */
class UserAuthorization extends QRFeedzModel
{
    use SoftDeletes;

    protected $table = 'authorizables';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function authorization()
    {
        return $this->belongsTo(Authorization::class);
    }

    public function clients()
    {
        return $this->belongsTo(Client::class, 'authorizable_id')
                    ->where('authorizable_type' == 'QRFeedz\\Cube\\Models\\Client');
    }

    public function questionnaires()
    {
        return $this->belongsTo(Questionnaire::class, 'authorizable_id')
                    ->where('authorizable_type' == 'QRFeedz\\Cube\\Models\\Questionnaire');
    }
}
