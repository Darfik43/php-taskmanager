<?php

namespace App\Authentication\Models;

use App\Models\TFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property string $token
 * @property string $created_at
 * @property string $expires_at
 * @property int $user_id
 * @property-read TFactory|null $use_factory
 * @method static Builder<static>|RefreshToken newModelQuery()
 * @method static Builder<static>|RefreshToken newQuery()
 * @method static Builder<static>|RefreshToken query()
 * @method static Builder<static>|RefreshToken whereCreatedAt($value)
 * @method static Builder<static>|RefreshToken whereExpiresAt($value)
 * @method static Builder<static>|RefreshToken whereId($value)
 * @method static Builder<static>|RefreshToken whereToken($value)
 * @method static Builder<static>|RefreshToken whereUserId($value)
 * @mixin Eloquent
 */
class RefreshToken extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'token',
        'created_at',
        'expires_at',
        'user_id'
    ];
}
