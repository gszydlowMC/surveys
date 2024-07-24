<?php

namespace App\Enums;

class UserStatusEnum implements EnumInterface
{
    const ACTIVE = 1;
    const INACTIVE = 0;

    public static function getList($id = null)
    {
        $items = [
            self::INACTIVE => 'Nieaktywny',
            self::ACTIVE => 'Aktywny',
        ];
        if ($id) {
            return $items[$id] ?? null;
        }

        return $items;
    }
}
