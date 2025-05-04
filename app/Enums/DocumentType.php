<?php

namespace App\Enums;

enum DocumentType
{
    const COLLECTION = [
        ['id' => 'DNI', 'name' => 'DNI - Documento Nacional de Identidad'],
        ['id' => 'RUC', 'name' => 'RUC - Regitro Único de Contribuyente'],
        ['id' => 'CE', 'name' => 'Carnet de Extranjería'],
        ['id' => 'PAS', 'name' => 'Pasaporte']
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
