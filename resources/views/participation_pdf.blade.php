<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lageranmeldung</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="container mt-5">
    <h2 class="text-center mb-3 text-2xl font-bold">Anmeldung zum Bezirkslager 2022</h2>

    <table class="table table-bordered mb-5">
        <tbody>
        <tr>
            <td>// TODO: Lagerdaten</td>
        </tr>
        </tbody>
    </table>

    <h3 class="ml-2 text-lg font-semibold">Basisdaten</h3>
    <table class="table table-bordered mb-5">
        <tbody>
            <tr>
                <td>Name</td><td>{{ $participation->firstname }} {{ $participation->lastname }}</td>
            </tr>
            <tr>
                <td>Geburtstag</td><td>{{ $participation->birthday }}</td>
            </tr>
            <tr>
                <td>Geschlecht</td><td>{{ $participation->gender }}</td>
            </tr>
        </tbody>
    </table>

    <h3 class="ml-2 text-lg font-semibold">Gruppe</h3>
    <table class="table table-bordered mb-5">
        <tbody>
            <tr>
                <td>Stamm</td><td>{{ $participation->stamm }}</td>
            </tr>
            <tr>
                <td>Stufe</td><td>{{ $participation->stufe }}</td>
            </tr>
        </tbody>
    </table>

    @if($participation->stufe == 'leiter')
    <h3 class="ml-2 text-lg font-semibold">Für Leitende</h3>
    <table class="table table-bordered mb-5">
        <tbody>
            <tr>
                <td>Rolle/Aufgabe</td><td>{{ $participation->role }}</td>
            </tr>
            <tr>
                <td>Ich habe eine Präventionsschulung (Modul 2d + 2e) besucht</td><td>{{ $participation->prevention }}</td>
            </tr>
        </tbody>
    </table>
    @endif

    <h3 class="ml-2 text-lg font-semibold">Email</h3>
    <table class="table table-bordered mb-5">
        <tbody>
            <tr>
                <td>Bitte schickt wichtige Infos zum Lager an folgende Email-Adresse:</td><td>{{ $participation->mail }}</td>
            </tr>
        </tbody>
    </table>

    <h3 class="ml-2 text-lg font-semibold">Krankenversicherung</h3>
    <table class="table table-bordered mb-5">
        <tbody>
            <tr>
                <td>Name des/der Hauptversicherten (über wen versichert?):</td><td>{{ $participation->insurance_person }}</td>
            </tr>
            <tr>
                <td>Krankenversicherung:</td><td>{{ $participation->insurance }}</td>
            </tr>
        </tbody>
    </table>

    <h3 class="ml-2 text-lg font-semibold">Impfungen</h3>
    <table class="table table-bordered mb-5">
        <tbody>
            <tr>
                <td colspan="2">// Empfehlung Tetanus, Zecken!</td>
            </tr>
            <tr>
                <td colspan="2">// Corona Impfung ggf. erforderlich zur Teilnahme, je nach Regelung im Sommer.</td>
            </tr>
            <tr>
                <td><label for="vaccination_info_confirmed">Ich habe die obenstehenden Hinweise zum Thema Impfung gelesen und verstanden</label></td><td><input type="checkbox" id="vaccination_info_confirmed" checked="{{ $participation->vaccination_info_confirmed }}" /></td>
            </tr>
        </tbody>
    </table>

    <h3 class="ml-2 text-lg font-semibold">Ernährung</h3>
    <table class="table table-bordered mb-5">
        <tbody>
            <tr>
                <td>Ernährung:</td><td>{{ $participation->food }}</td>
            </tr>
        </tbody>
    </table>

    <h3 class="ml-2 text-lg font-semibold">Kontaktdaten der Erziehungsberechtigten</h3>
    <table class="table table-bordered mb-5">
        <tbody>
            <tr>
                <td>Telefon:</td><td>{{ $participation->parent_phone }}</td>
            </tr>
            <tr>
                <td>Handy:</td><td>{{ $participation->parent_mobile }}</td>
            </tr>
            <tr>
                <td>Anschrift (während des Lagers):</td><td>{{ $participation->parent_address }}</td>
            </tr>
        </tbody>
    </table>

    <table class="table table-bordered mb-5">
        <tbody>
        <tr>
            <td>//TODO: Foto Einverständnis</td>
        </tr>
        </tbody>
    </table>

    <span>Unterschrift Teilnehmer*in</span>
    <table class="table table-bordered mb-2">
        <tbody>
        <tr>
            <td>&nbsp;</td>
        </tr>
        </tbody>
    </table>
    <span>Unterschrift Erziehungsberechtigte*r</span>
    <table class="table table-bordered mb-2">
        <tbody>
        <tr>
            <td>&nbsp;</td>
        </tr>
        </tbody>
    </table>
</div>

</body>

</html>