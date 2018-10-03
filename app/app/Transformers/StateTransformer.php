<?php

namespace App\Transformers;

use App\Entities\State;
use League\Fractal\TransformerAbstract;

/**
 * Class StateTransformer.
 *
 * @package namespace App\Transformers;
 */
class StateTransformer extends TransformerAbstract
{
    /**
     * Transform the State entity.
     *
     * @param \App\Entities\State $model
     *
     * @return array
     */
    public function transform(State $model)
    {
        return [
            'id' => (int)$model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
        ];
    }
}
