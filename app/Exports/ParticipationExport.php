<?php

namespace App\Exports;

use App\Http\Controllers\Participation\ParticipationController;
use App\Models\Participation;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ParticipationExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize
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
                'bus_there',
                'bus_back',
                'travel_comment',
                'applied_at',
                'signed_at',
                'paid_at',
            ]);
    }

    /**
     * @var Participation $participation
     */
    public function map($participation): array
    {
        return [
            $participation->firstname,
            $participation->lastname,
            $participation->birthday,
            ParticipationController::$Genders[$participation->gender] ?? $participation->gender,
            $participation->stamm,
            ParticipationController::$Tribes[$participation->stamm]['name'] ?? '',
            ParticipationController::$Stufen[$participation->stufe] ?? $participation->stufe,
            ParticipationController::$Roles[$participation->role] ?? '',
            $participation->prevention ? 'ja' : 'nein',
            $participation->mail,
            ParticipationController::$Foods[$participation->food] ?? $participation->food,
            $participation->gluten ? 'ja' : 'nein',
            $participation->lactose ? 'ja' : 'nein',
            $participation->allergies,
            $participation->parent_name,
            $participation->parent_phone,
            $participation->parent_mobile,
            $participation->parent_address,
            $participation->bus_there ? 'ja' : 'nein',
            $participation->bus_back ? 'ja' : 'nein',
            $participation->travel_comment,
            $participation->applied_at,
            $participation->signed_at,
            $participation->paid_at,
        ];
    }

    public function headings(): array
    {
        return [
            'Vorname',
            'Nachname',
            'Geburtstag',
            'Geschlecht',
            'Stammesnummer',
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
            'Bus Hinfahrt',
            'Bus Rückfahrt',
            'Kommentar zur Fahrt',
            'angemeldet am',
            'unterschrieben am',
            'bezahlt am',
        ];
    }
}
