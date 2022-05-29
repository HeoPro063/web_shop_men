<?php

namespace App\Validators;

use Illuminate\Contracts\Validation\Factory;
use Prettus\Validator\LaravelValidator;

/**
 * Class FormValidator.
 */
class CategoryValidator extends LaravelValidator
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
                'name' => 'required|max:200|unique:categories',
            ],
            BaseValidatorInterface::RULE_UPDATE => [
                'name' => 'required|max:200|unique:categories,name,:id',
            ],
        ];

        /*
         *
         * Validator attributes
         *
         */
        $this->attributes = [
            'name' => __('Category'),
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
