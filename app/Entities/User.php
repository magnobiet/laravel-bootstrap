<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * @property mixed roles
 */
class User extends Authenticatable implements AuditableContract, Transformable
{
    use HasApiTokens, Notifiable, Auditable, TransformableTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo_url',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the roles record associated with the user.
     */
    public function roles()
    {

        return $this->belongsToMany(Role::class);

    }

    /**
     * @param Permission $permission
     *
     * @return bool
     */
    public function hasPermission(Permission $permission)
    {

        return $this->hasAnyRole($permission->roles);

    }

    /**
     * @param Roles $roles
     *
     * @return bool
     */
    public function hasAnyRole($roles)
    {

        if (is_array($roles) || is_object($roles)) {
            return !!$roles->intersect($this->roles)->count();
        }

        return $this->roles->contains('name', $roles);

    }

}
