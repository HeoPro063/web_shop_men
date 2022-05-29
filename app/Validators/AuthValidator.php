<?php

namespace App\Validators;

use Illuminate\Contracts\Validation\Factory;
use Prettus\Validator\LaravelValidator;

/**
 * Class FormValidator.
 */
class AuthValidator extends LaravelValidator
{
    /**
     * FormValidator constructor.
     */
    public function __construct(Factory $validator)
    {
        parent::__construct($validator);

        /*
         *
         * Validator rules
         *
         */
        $this->rules = [
            BaseValidatorInterface::RULE_LOGIN => [
                'email' => 'required',
                'password' => 'required',
            ]
        ];

        /*
         *
         * Validator attributes
         *
         */
        $this->attributes = [
            'email' => __('Email'),
            'password' => __('Password'),
        ];

        /*
         *
         * Validator messages
         *
         */
        $this->messages = [
            'required' => ':attribute' . __(' name is empty'),
        ];
    }
}
