<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Role.
 *
 * @package namespace App\Entities;
 */
class Role extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Get the role that owns the user.
     */
    public function user()
    {

        return $this->belongsTo(User::class);

    }

    /**
     * Get the permissions for the user role.
     */
    public function permissions()
    {

        return $this->belongsToMany(Permission::class);

    }

}
