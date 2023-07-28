<?php

namespace App\Enums;

final class AnswerType
{
    const SINGLE_CHOICE     = 'App\Models\AnswersTypeSingleChoice';
    const MULTIPLE_CHOICE   = 'App\Models\AnswersTypeMultipleChoice';
    const RIGHT_ORDER       = 'App\Models\AnswersTypeRightOrder';
    const TEXT_INPUT        = 'App\Models\AnswersTypeTextInput';

    const TYPES = [
        self::SINGLE_CHOICE     => 'Выбор одного варианта ответа',
        self::MULTIPLE_CHOICE   => 'Выбор нескольких вариантов ответа',
        self::RIGHT_ORDER       => 'Расстановка в нужном порядке',
        self::TEXT_INPUT        => 'Ввод ответа с клавиатуры'
    ];
}