<?php

namespace App\Enums;

enum PositionType
{
    const COLLECTION = [
        ['id' => 'fit', 'name' => 'Fit del puesto'],
        ['id' => 'potential', 'name' => 'Potencial'],
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
