<?php

return [
    'required' => 'Пареметр :attribute отсутствует',

    'min' => [
        'array' => 'Поле :attribute должно иметь не менее :min элементов.',
        'file' => 'Поле :attribute должно быть не менее :min килобайт.',
        'numeric' => 'Поле :attribute должно быть не менее :min.',
        'string' => 'Поле :attribute должно содержать не менее :min символов.',
    ],

    'max' => [
        'array' => 'Поле :attribute не должно иметь более чем :max элементов.',
        'file' => 'Поле :attribute не должно быть больше, чем :max килобайт.',
        'numeric' => 'Поле :attribute не должно быть больше, чем :max.',
        'string' => 'Поле :attribute не должно быть больше, чем :max символов.',
    ],

    'alpha' => 'Поле :attribute должно содержать только буквы.',
    'alpha_dash' => 'Поле :attribute должно содержать только буквы, цифры, тире и знаки подчеркивания.',
    'alpha_num' => 'Поле :attribute должно содержать только буквы и цифры.',

    'boolean' => 'Поле :attribute должно быть true или false.',

    'numeric' => 'Поле :attribute должно быть числом.',
];
