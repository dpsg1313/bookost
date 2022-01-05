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
    <h2 class="text-center mb-3">Anmeldung</h2>

    <table class="table table-bordered mb-5">
        <tbody>
            <tr>
                <td>Name</td><td>{{ $participation->firstname }} {{ $participation->lastname }}</td>
            </tr>
            <tr>
                <td>Geburtstag</td><td>{{ $participation->birthday }}</td>
            </tr>
            <tr>
                <td>Stamm</td><td>{{ $participation->stamm }}</td>
            </tr>
        </tbody>
    </table>

    <span>Unterschrift Teilnehmer*in</span>
    <hr>
    <span>Unterschrift Erziehungsberechtigte*r</span>
    <hr>
</div>

</body>

</html>