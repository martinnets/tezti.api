<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\ScormPackage;
use App\Models\ScormProgress;
use Illuminate\Support\Facades\Auth;
use SimpleXMLElement;
use stdClass;

class ScormPackageController extends Controller
{
    protected $scormBasePath;
    
    public function __construct()
    {
        $this->scormBasePath = storage_path('app/public/scorm_packages');
    }
    
    /**
     * Muestra la lista de paquetes SCORM disponibles
     */
    public function index()
    {
        $xml_path = storage_path('app/public/');
        // $packages = ScormPackage::orderBy('order', 'asc')->get();
        // return view('scorm.index', compact('packages'));
        return  $xml_path;
    }
    
    /**
     * Carga un paquete SCORM específico
     */
    public function show($id)
    {
        $xml_path = storage_path('app/public/scorm_packages/'.$id. '/imsmanifest.xml');
        // $scorm_manifiest = simplexml_load_file($xml_path);
        // print_r($scorm_manifiest);
        if (file_get_contents($xml_path)) {
           // dd($xml_path);
            $scorm_manifiest = simplexml_load_file($xml_path);
           // print_r($scorm_manifiest);
            // if ($scorm_manifiest) {
            //     foreach ($scorm_manifiest->resources->resource as $resource) {
            //         print_r(isset($resource['href']));
            //         if (isset($resource['href'])) {
            //             $scorm_path = config('app.evaluation_url') . '/storage/' . $scorm_base . (string) $resource['href'];
            //             print_r($scorm_path);
            //             //$scorm_path = $scorm_base . (string) $resource['href'];
            //             break; 
            //         }
            //     }
            // }
        }
        return view('scorm.show', compact('package', 'nextPackage', 'progress'));
        //return $xml_path;
        //return view('scorm.show', compact('case', 'position_id', 'position', 'user', 'token', 'position_user', 'scorm_path', 'behavior_id', 'new_status'));

        //$package = ScormPackage::findOrFail($id);
        // $nextPackage = ScormPackage::where('order', '>', $package->order)
        //                            ->orderBy('order', 'asc')
        //                            ->first();
        
        // // Verificar si el directorio existe
        // $packagePath = $this->scormBasePath . '/' . $package->folder_name;
        
        // if (!File::isDirectory($packagePath)) {
        //     return redirect()->route('scorm.index')
        //                     ->with('error', 'El paquete SCORM no se encuentra en el sistema de archivos');
        // }
        
        // // Obtener o crear el progreso del usuario
        // $progress = ScormProgress::firstOrCreate([
        //     'user_id' => Auth::id(),
        //     'scorm_package_id' => $package->id
        // ]);
        
        // return view('scorm.show', compact('package', 'nextPackage', 'progress'));
    }
    
    /**
     * Carga el siguiente paquete SCORM
     */
    public function loadNext($currentId)
    {
        $currentPackage = ScormPackage::findOrFail($currentId);
        $nextPackage = ScormPackage::where('order', '>', $currentPackage->order)
                                   ->orderBy('order', 'asc')
                                   ->first();
        
        if ($nextPackage) {
            return redirect()->route('scorm.show', $nextPackage->id);
        }
        
        return redirect()->route('scorm.index')
                        ->with('message', 'Has completado todos los paquetes SCORM disponibles.');
    }
    
    /**
     * Obtiene la ruta al archivo imsmanifest.xml del paquete SCORM
     */
    public function getManifest($id)
    {
        $package = ScormPackage::findOrFail($id);
        $manifestPath = $this->scormBasePath . '/' . $package->folder_name . '/imsmanifest.xml';
        
        if (File::exists($manifestPath)) {
            return response()->file($manifestPath);
        }
        
        return response()->json(['error' => 'Manifest file not found'], 404);
    }
    
    /**
     * Sirve los archivos del paquete SCORM
     */
    public function serveFile($id, $filePath)
    {
        $package = ScormPackage::findOrFail($id);
        $fullPath = $this->scormBasePath . '/' . $package->folder_name . '/' . $filePath;
        
        if (File::exists($fullPath)) {
            $mimeType = File::mimeType($fullPath);
            return response()->file($fullPath, ['Content-Type' => $mimeType]);
        }
        
        return response()->json(['error' => 'File not found'], 404);
    }
    
    /**
     * Guarda el progreso del paquete SCORM
     */
    public function saveProgress(Request $request, $id)
    {
        $validated = $request->validate([
            'location' => 'nullable|string',
            'completion_status' => 'nullable|string',
            'score' => 'nullable|numeric',
            'suspend_data' => 'nullable|string',
        ]);
        
        $progress = ScormProgress::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'scorm_package_id' => $id
            ],
            $validated
        );
        
        return response()->json(['status' => 'success']);
    }
}