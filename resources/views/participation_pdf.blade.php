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
    <h2 class="text-center mb-3">Anmeldung zum Bezirkslager 2022</h2>

    <div>
        // TODO: Lagerdaten
    </div>

    <h3>Basisdaten</h3>
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

    <h3>Gruppe</h3>
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
    <h3>Für Leitende</h3>
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

    <h3>Email</h3>
    <table class="table table-bordered mb-5">
        <tbody>
            <tr>
                <td>Bitte schickt wichtige Infos zum Lager an folgende Email-Adresse:</td><td>{{ $participation->mail }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Krankenversicherung</h3>
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

    <h3>Impfungen</h3>
    <p>// Empfehlung Tetanus, Zecken!</p>
    <p>// Corona Impfung ggf. erforderlich zur Teilnahme, je nach Regelung im Sommer.</p>
    <table class="table table-bordered mb-5">
        <tbody>
            <tr>
                <td><label for="vaccination_info_confirmed">Ich habe die obenstehenden Hinweise zum Thema Impfung gelesen und verstanden</label></td><td><input type="checkbox" id="vaccination_info_confirmed" checked="{{ $participation->vaccination_info_confirmed }}" /></td>
            </tr>
        </tbody>
    </table>

    <h3>Ernährung</h3>
    <table class="table table-bordered mb-5">
        <tbody>
            <tr>
                <td>Ernährung:</td><td>{{ $participation->food }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Kontaktdaten der Erziehungsberechtigten</h3>
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

    <div>
        //TODO: Foto Einverständnis
    </div>

    <span>Unterschrift Teilnehmer*in</span>
    <hr>
    <span>Unterschrift Erziehungsberechtigte*r</span>
    <hr>
</div>

</body>

</html>