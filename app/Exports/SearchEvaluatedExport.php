<?php

namespace App\Exports;

use App\Models\Position;
use App\Models\PositionUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SearchEvaluatedExport implements FromCollection, WithHeadings
{
    protected $filters;
    protected $user;


    /**
     * Summary of __construct
     * @param mixed $filters
     * @param mixed $user
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
            'ID',
            'Nombres',
            'Apellidos',
            'Tipo documento',
            'Nro documento',
            'Email',
            'ID Proceso',
            'Proceso',
            'Deadline',
            'Progreso',
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

        $evaluateds = PositionUser::with(['position', 'position.hierarchicalLevel', 'user'])
            ->where(function ($query) use ($request) {
                if ($this->user->organization_id) {
                    $query->whereHas('position', function ($subquery) use ($request) {
                        $subquery->where('organization_id', $this->user->organization_id);
                        if ($request->get('hierarchical_level_id')) {
                            $subquery->where('hierarchical_level_id', $request->get('hierarchical_level_id'));
                        }
                    });
                }
                if ($request->get('position_id')) {
                    $query->where('position_id', $request->get('position_id'));
                }
                if ($this->user->role == 'C') {
                    $query->whereHas('position', function ($subquery) use ($request) {
                        $subquery->where('user_id', $this->user->id);
                    });
                }
                if ($request->get('text')) {
                    $query->whereHas('user', function ($subquery) use ($request) {
                        $subquery->whereRaw("unaccent(name) ILIKE unaccent(?)", ['%' . $request->input('text') . '%']);
                        $subquery->orWhereRaw("unaccent(lastname) ILIKE unaccent(?)", ['%' . $request->input('text') . '%']);
                    });
                }
                if ($request->get('status')) {
                    $query->where('status', $request->get('status'));
                }
            })
            ->get();

        $items = $evaluateds->map(function ($evaluated) {
            return [
                'ID' => $evaluated->id,
                'Nombres' => $evaluated->user->name,
                'Apellidos' => $evaluated->user->lastname,
                'Tipo documento' => $evaluated->user->document_type_label,
                'Nro documento' => $evaluated->user->document_number,
                'Email' => $evaluated->user->email,
                'ID Proceso' => isset($evaluated->position) ? $evaluated->position->id : '',
                'Proceso' => isset($evaluated->position) ? $evaluated->position->name : '',
                'Deadline' => $evaluated->deadline_at,
                'Progreso' => abs($evaluated->progress) * 100 . '%',
                'Estado' => $evaluated->status_label
            ];
        });

        return collect($items);
    }
}
