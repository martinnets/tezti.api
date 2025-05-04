<?php

namespace App\Enums;

enum PositionStatus
{
    const COLLECTION = [
        ['id' => 1, 'name' => 'Abierto'],
        ['id' => 0, 'name' => 'Inactivo'],
        ['id' => 2, 'name' => 'Cerrado']
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
