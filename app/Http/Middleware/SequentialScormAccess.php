<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ScormPackage;
use App\Models\ScormProgress;

class SequentialScormAccess
{
    /**
     * Middleware para garantizar que los paquetes SCORM se accedan secuencialmente.
     * Verifica que el usuario haya completado los paquetes anteriores antes de acceder a uno.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $scormId = $request->route('id');
        $package = ScormPackage::findOrFail($scormId);
        $userId = auth()->id();
        
        // Si es el primer paquete en la secuencia, permitir acceso
        if ($package->sequence == 1) {
            return $next($request);
        }
        
        // Verificar que el usuario haya completado los paquetes anteriores
        $previousPackage = ScormPackage::where('sequence', '<', $package->sequence)
                                       ->orderBy('sequence', 'desc')
                                       ->first();
        
        if ($previousPackage) {
            $previousProgress = ScormProgress::where('user_id', $userId)
                                          ->where('scorm_package_id', $previousPackage->id)
                                          ->first();
            
            // Si no existe progreso o no está completado, redirigir al paquete anterior
            if (!$previousProgress || !in_array($previousProgress->status, ['completed', 'passed'])) {
                return redirect()->route('scorm.launch', $previousPackage->id)
                                ->with('warning', 'Debes completar el paquete anterior antes de continuar.');
            }
        }
        
        return $next($request);
    }
}