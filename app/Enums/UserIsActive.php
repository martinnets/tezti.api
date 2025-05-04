<?php

namespace App\Enums;

enum UserIsActive
{
    const COLLECTION = [
        ['id' => 1, 'name' => 'Activo'],
        ['id' => 0, 'name' => 'Inactivo']
    ];

    public static function getName($id)
    {
        foreach (self::COLLECTION as $item) {
            if ($item['id'] == $id) {
                return $item['name'];
            }
        }
        return null; // Retorna null si no encuentra el código
    }
}
