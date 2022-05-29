<?php

namespace App\Validators;

use Illuminate\Contracts\Validation\Factory;
use Prettus\Validator\LaravelValidator;

/**
 * Class FormValidator.
 */
class ProductValidator extends LaravelValidator
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
                'name' => 'required|max:200|unique:products',
                'price' => 'required',
                'quantity' => 'required',
                'description' => 'required',

            ],
            BaseValidatorInterface::RULE_UPDATE => [
                'name' => 'required|max:200|unique:products,name,:id',
                'price' => 'required',
                'quantity' => 'required',
                'description' => 'required',
            ],
        ];

        /*
         *
         * Validator attributes
         *
         */
        $this->attributes = [
            'name' => __('Product name'),
            'price' => __('Price'),
            'quantity' => __('Quantity'),
            'description' => __('Description'),
        ];

        /*
         *
         * Validator messages
         *
         */
        $this->messages = [
            'required' => ':attribute' . __('is empty'),
            'max' => ':attribute' . __('name length is too long'),
            'unique' => ':attribute' . __('name already exists'),
        ];
    }
}
