<?php

namespace App\Enums;

class SubscribeImportMapColumnEnum implements EnumInterface
{

    public static function getList($id = null)
    {
        $items = [
            'Imię' => 'first_name',
            'Nazwisko' => 'last_name',
            'Email' => 'email',
            'Telefon' => 'phone',
            'Grupa' => 'subscriber_group_name',
        ];
        if ($id) {
            return $items[$id] ?? null;
        }

        return $items;
    }
}
