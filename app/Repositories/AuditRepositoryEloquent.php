<?php

namespace App\Repositories;

use App\Entities\Audit;
use App\Validators\AuditValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class AuditRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AuditRepositoryEloquent extends BaseRepository implements AuditRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Audit::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return AuditValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
