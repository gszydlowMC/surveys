<?php

namespace App\Enums;

class DiskTypeEnum implements EnumInterface
{

    const PUBLIC = 'public';

    public static function getList($id = null)
    {
        $items = [
            self::PUBLIC => 'Publiczne',
        ];
        if ($id) {
            return $items[$id] ?? null;
        }

        return $items;
    }
}
