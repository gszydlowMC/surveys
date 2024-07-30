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

    const DATE = 'date';

    public static function getList($id = null)
    {
        $items = [
            (object)['value' => self::SHORT_ANSWER, 'name' => 'Krótka odpowiedź'],
            (object)['value' => self::LONG_ANSWER, 'name' => 'Długa odpowiedź'],
            (object)['value' => self::ONCE_LIST, 'name' => 'Jednokrotny wybór', 'type' => 'list'],
            (object)['value' => self::MULTI_LIST, 'name' => 'Wielokrotny wybór', 'type' => 'list'],
            (object)['value' => self::SELECT, 'name' => 'Rozwijana lista', 'type' => 'list'],
            (object)['value' => self::SCALE, 'name' => 'Skala liniowa'],
            (object)['value' => self::SCALE, 'name' => 'Data'],
        ];
        if ($id) {
            return $items[$id] ?? null;
        }

        return $items;
    }
}
