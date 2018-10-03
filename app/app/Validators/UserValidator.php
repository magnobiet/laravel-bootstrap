<?php

namespace App\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

/**
 * Class UserValidator.
 *
 * @package namespace App\Validators;
 */
class UserValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name'     => 'required',
            'email'    => 'email|required',
            'password' => 'min:6|required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name'  => 'required',
            'email' => 'email|required',
        ],
    ];
}
