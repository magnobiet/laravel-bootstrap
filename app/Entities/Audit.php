<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Audit.
 *
 * @package namespace App\Entities;
 */
class Audit extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * Get the state that owns the city.
     */
    public function user()
    {

        return $this->belongsTo(User::class, 'user_id');

    }

}
