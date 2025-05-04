<?php

namespace App\Enums;

enum PositionUserStatus
{
    const COLLECTION = [
        ['id' => 2, 'name' => 'Finalizado'],
        ['id' => 1, 'name' => 'En proceso'],
        ['id' => 0, 'name' => 'Invitado'],
        ['id' => -1, 'name' => 'Sin iniciar']
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
