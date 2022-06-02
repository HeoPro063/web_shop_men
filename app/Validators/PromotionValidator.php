<?php

namespace App\Validators;

use Illuminate\Contracts\Validation\Factory;
use Prettus\Validator\LaravelValidator;

/**
 * Class FormValidator.
 */
class PromotionValidator extends LaravelValidator
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
            BaseValidatorInterface::RULE_CREATE => [
                'name' => 'required|max:200|unique:promotions',
            ],
            BaseValidatorInterface::RULE_UPDATE => [
                'name' => 'required|max:200|unique:promotions,name,:id',
            ],
        ];

        /*
         *
         * Validator attributes
         *
         */
        $this->attributes = [
            'name' => __('Promotion'),
        ];

        /*
         *
         * Validator messages
         *
         */
        $this->messages = [
            'required' => ':attribute' . __('name is empty'),
            'max' => ':attribute' . __('name length is too long'),
            'unique' => ':attribute' . __('name already exists'),
        ];
    }
}
