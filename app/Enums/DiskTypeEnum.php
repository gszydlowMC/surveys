<?php

namespace App\Enums;

class DiskTypeEnum implements EnumInterface
{
    const LOCAL = 'local';

    const PUBLIC = 'public';
    const USER_FILES = 'user_files';

    public static function getList($id = null)
    {
        $items = [
            self::LOCAL => 'Lokalne',
            self::PUBLIC => 'Publiczne',
            self::USER_FILES => 'Pliki użytkowników',
        ];
        if ($id) {
            return $items[$id] ?? null;
        }

        return $items;
    }
}
