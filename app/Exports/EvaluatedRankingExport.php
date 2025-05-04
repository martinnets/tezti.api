<?php

namespace App\Exports;

use App\Models\Classification;
use App\Models\Position;
use App\Models\PositionUser;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EvaluatedRankingExport implements FromCollection, WithHeadings
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
            '#',
            'Proceso',
            'Nombres y apellidos',
            'Resultado cuantitativo',
            'Resultado cualitativo',
            'Observado'
        ];
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection(): Collection
    {
        $items = [];
        $request = $this->filters;


        $results = PositionUser::with(['position', 'user'])
            ->where(function ($query) use ($request) {
                if ($request->has('position_id') && is_numeric($request->get('position_id'))) {
                    $query->where('position_id', $request->get('position_id'));
                }
                if ($request->has('hierarchical_level_id') && is_numeric($request->get('hierarchical_level_id'))) {
                    $query->whereHas('position', function ($subquery) use ($request) {
                        $subquery->where('hierarchical_level_id', $request->get('hierarchical_level_id'));
                    });
                }
                if ($request->has('text') && $request->get('text')) {
                    $query->whereHas('user', function ($subquery) use ($request) {
                        $subquery->whereRaw("unaccent(name) ILIKE unaccent(?)", ['%' . $request->input('text') . '%']);
                        $subquery->orWhereRaw("unaccent(lastname) ILIKE unaccent(?)", ['%' . $request->input('text') . '%']);
                        $subquery->orWhereRaw("unaccent(email) ILIKE unaccent(?)", ['%' . $request->input('text') . '%']);
                    });
                }
                if ($this->user->role == 'C') {
                    $query->whereHas('position', function ($subquery) use ($request) {
                        $subquery->where('user_id', $this->user->id);
                        return $subquery;
                    });
                }
                if ($request->has('result_from') && $request->get('result_from')) {
                    $query->where('result', '>=', $request->get('result_from'));
                }
                if ($request->has('result_to') && $request->get('result_to')) {
                    $query->where('result', '<=', $request->get('result_to'));
                }
            })
            ->where('status', 2)
            ->whereNotIn('position_id', Position::withTrashed()->whereNotNull('deleted_at')->pluck('id'))
            ->orderBy('result', 'DESC')
            ->get();

        //Obtaining list of classifications
        $classifications = Classification::where('is_active', true)->get();
        $results_final = [];
        $i = 0;
        foreach ($results as $result) {
            $result_classification = "";
            $result_classification_code = "";
            foreach ($classifications as $classification) {
                if ($classification->from <= $result->result && $classification->to >= $result->result) {
                    $result_classification = $classification->name;
                    $result_classification_code = $classification->code;
                }
            }

            $results_final[] = [
                '#' => ++$i,
                'Proceso' => $result->position->name,
                'Nombres y apellidos' => $result->user->name . ' ' . $result->user->lastname,
                'Resultado cuantitativo' => $result->result,
                'Resultado cualitativo' => $result_classification,
                'Observado' => $result->observed_comments
            ];
        }

        return collect($results_final);
    }
}
