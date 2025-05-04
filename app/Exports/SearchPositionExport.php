<?php

namespace App\Exports;

use App\Models\Position;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SearchPositionExport implements FromCollection, WithHeadings
{
    protected $filters;
    protected $user;


    /**
     * Summary of __construct
     * @param mixed $filters
     */
    public function __construct($filters, $user)
    {
        $this->filters = $filters;
        $this->user = $user;
    }


    /**
     * Summary of headings
     * @return array
     */
    public function headings(): array
    {
        return [
            'Organización',
            'Creador',
            'ID Proceso',
            'Proceso',
            'Tipo',
            'Inicio',
            'Fin',
            'Estado'
        ];
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection(): Collection
    {
        $items = [];
        $request = $this->filters;

        $where = function ($query) use ($request) {
            if ($request->has('organization_id')) {
                $query->where('organization_id', $request->input('organization_id'));
            }
            if ($request->has('user_id')) {
                $query->where('user_id', $request->input('user_id'));
            }
            if ($this->user->role == 'C') {
                $query->where('user_id', $this->user->id);
            }
            if ($request->has('text')) {
                $query->whereRaw("unaccent(name) ILIKE unaccent(?)", ['%' . $request->input('text') . '%']);
            }
            if ($request->has('from') && $request->has('from')) {
                $from = Carbon::parse($request->input('from'))->format('Y-m-d');
                $to = Carbon::parse($request->input('to'))->format('Y-m-d');

                $query->whereBetween('from', [$from, $to]);
                $query->orwhereBetween('to', [$from, $to]);
            } else {
                if ($request->has('from')) {
                    $from = Carbon::parse($request->input('from'))->format('Y-m-d');
                    $query->where(function ($subquery) use ($from) {
                        $subquery->where('from', '>=', $from);
                        $subquery->orWhere('to', '>=', $from);
                    });
                }
                if ($request->has('to')) {
                    $to = Carbon::parse($request->input('to'))->addDay()->format('Y-m-d');
                    $query->where(function ($subquery) use ($to) {
                        $subquery->where('from', '<', $to);
                        $subquery->orWhere('to', '<', $to);
                    });
                }
            }
            if ($request->has('hierarchical_level_id')) {
                $query->where('hierarchical_level_id', $request->input('hierarchical_level_id'));
            }
            $query->where('status', '<>', -1);
            if ($request->has('status')) {
                $query->where('status', $request->input('status'));
            }
        };

        // Consulta con paginación y ordenamiento
        $positions = Position::with(['organization', 'hierarchicalLevel', 'creator'])
            ->where($where)
            ->selectRaw("*, 0 AS progress")
            ->get();

        $items = $positions->map(function ($position) {
            return [
                'Organización' => $position->organization->name ?? '',
                'Creador' => $position->creator->name ?? '',
                'ID Proceso' => $position->id,
                'Proceso' => $position->name,
                'Tipo' => $position->type == 'fit' ? 'Fit del puesto' : 'Potencial',
                'Inicio' => $position->from,
                'Fin' => $position->to,
                'Estado' => $position->status_label
            ];
        });

        return collect($items);
    }
}
