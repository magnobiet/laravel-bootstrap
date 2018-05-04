<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Audit;

/**
 * Class AuditTransformer.
 *
 * @package namespace App\Transformers;
 */
class AuditTransformer extends TransformerAbstract
{
    /**
     * Transform the Audit entity.
     *
     * @param \App\Entities\Audit $model
     *
     * @return array
     */
    public function transform(Audit $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
