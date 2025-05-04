<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class ScormPlayer extends Component
{
    public $currentScorm;
    public $nextScorm;
    public $scormPath;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($scormIdentifier)
    {
        $this->scormPath = 'scorm/';
        $scormFiles = Storage::disk('local')->files($this->scormPath);

        // Filtrar solo archivos .zip (asumimos que los SCORM están en formato ZIP)
        $scormZips = collect($scormFiles)->filter(function ($file) {
            return pathinfo($file, PATHINFO_EXTENSION) === 'zip';
        })->values()->toArray();

        // Lógica para encontrar el SCORM actual y el siguiente
        $currentIndex = array_search($this->scormPath . $scormIdentifier . '.zip', $scormZips);

        if ($currentIndex !== false) {
            $this->currentScorm = $scormIdentifier;
            $this->nextScorm = isset($scormZips[$currentIndex + 1]) ? pathinfo($scormZips[$currentIndex + 1], PATHINFO_FILENAME) : null;

            // Descomprimir el SCORM actual si no está descomprimido
            $extractPath = storage_path('app/scorm_extracted/' . $this->currentScorm);
            if (!is_dir($extractPath)) {
                $zip = new ZipArchive;
                if ($zip->open(Storage::disk('local')->path($this->scormPath . $this->currentScorm . '.zip')) === TRUE) {
                    $zip->extractTo($extractPath);
                    $zip->close();
                } else {
                    // Manejar el error de apertura del ZIP
                    // Puedes loguear o mostrar un mensaje al usuario
                    dd("Error al abrir el archivo ZIP: " . $this->scormPath . $this->currentScorm . ".zip");
                }
            }
        } else {
            $this->currentScorm = null;
            $this->nextScorm = null;
            // Manejar el caso en que el SCORM solicitado no se encuentra
            dd("El SCORM con identificador: " . $scormIdentifier . " no se encontró.");
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.scorm-player');
    }
}