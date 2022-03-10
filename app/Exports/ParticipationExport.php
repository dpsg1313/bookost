<?php

namespace App\Exports;

use App\Models\Participation;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ParticipationExport implements FromQuery, WithHeadings, ShouldAutoSize
{
    use Exportable;

    private $tribes;

    public function forTribes($tribes)
    {
        $this->tribes = $tribes;

        return $this;
    }

    public function query()
    {
        return Participation::query()->whereNotNull('applied_at')->whereIn('stamm', $this->tribes)
            ->select([
                'firstname',
                'lastname',
                'birthday',
                'gender',
                'stamm',
                'stufe',
                'role',
                'prevention',
                'mail',
                'food',
                'gluten',
                'lactose',
                'allergies',
                'parent_name',
                'parent_phone',
                'parent_mobile',
                'parent_address',
                'applied_at',
                'signed_at',
                'paid_at',
            ]);
    }

    public function headings(): array
    {
        return [
            'Vorname',
            'Nachname',
            'Geburtstag',
            'Geschlecht',
            'Stamm',
            'Stufe',
            'Aufgabe',
            'Präventionsschulung absolviert',
            'Email für Infos',
            'Essen',
            'glutenfrei',
            'laktosefrei',
            'Allergien/Unverträglichkeiten',
            'Eltern Name',
            'Eltern Telefon',
            'Eltern Handy',
            'Eltern Adresse',
            'angemeldet am',
            'unterschrieben am',
            'bezahlt am',
        ];
    }
}
