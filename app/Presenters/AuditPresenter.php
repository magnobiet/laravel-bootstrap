<?php

namespace App\Presenters;

use App\Transformers\AuditTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AuditPresenter.
 *
 * @package namespace App\Presenters;
 */
class AuditPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AuditTransformer();
    }
}
