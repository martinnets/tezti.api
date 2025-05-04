<?php

namespace App\Enums;

enum RoleUser
{
    const COLLECTION = [
        ['id' => 'U', 'name' => 'Usuario'],
        ['id' => 'S', 'name' => 'Superadmin'],
        ['id' => 'C', 'name' => 'Admin cliente']
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
