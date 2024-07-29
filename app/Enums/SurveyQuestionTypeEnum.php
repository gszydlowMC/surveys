<?php

namespace App\Enums;

class SurveyQuestionTypeEnum implements EnumInterface
{
    const SHORT_ANSWER = 'text';
    const LONG_ANSWER = 'textarea';
    const ONCE_LIST = 'radio';
    const MULTI_LIST = 'checkbox';

    const SELECT = 'select';
    const SCALE = 'scale';

    public static function getList($id = null)
    {
        $items = [
            (object)['value' => self::SHORT_ANSWER, 'name' => 'Krótka odpowiedź'],
            (object)['value' => self::LONG_ANSWER, 'name' => 'Długa odpowiedź'],
            (object)['value' => self::ONCE_LIST, 'name' => 'Jednokrotny wybór'],
            (object)['value' => self::MULTI_LIST, 'name' => 'Wielokrotny wybór'],
            (object)['value' => self::SELECT, 'name' => 'Rozwijana lista'],
            (object)['value' => self::SCALE, 'name' => 'Skala liniowa'],
        ];
        if ($id) {
            return $items[$id] ?? null;
        }

        return $items;
    }
}
