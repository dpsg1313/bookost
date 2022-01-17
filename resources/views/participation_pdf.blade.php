<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lageranmeldung</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .page-header, .page-header-space {
            height: 200px;
        }

        @page {
            margin: 20mm
        }

        @media print {
            thead {display: table-header-group;}
            tfoot {display: table-footer-group;}

            button {display: none;}

            body {margin: 0;}

            div.page-header {
                position: fixed;
                top: 10mm;
                right: 10mm;
                left: 10mm;
            }
        }
    </style>
</head>

<body>

<div class="page-header" style="text-align: center">
    <div class="header flex justify-between items-center">
        <h2 class="inline-flex text-center mb-3 text-3xl font-bold">Anmeldung zum Bezirkslager 2022</h2>
        <img class="inline-flex justify-end h-20" src="{{asset('images/München-Ost_Logo2_noBackground.png')}}" alt="Logo DPSG München-Ost" />
    </div>
</div>

<table>

    <thead>
    <tr>
        <td>
            <!--place holder for the fixed-position header-->
            <div class="page-header-space"></div>
        </td>
    </tr>
    </thead>

    <tbody>
    <tr>
        <td>
            <!--*** CONTENT GOES HERE ***-->
            <div class="container">



                <table class="table table-bordered mb-5">
                    <tbody>
                    <tr>
                        <td>// TODO: Lagerdaten</td>
                    </tr>
                    </tbody>
                </table>

                <div class="break-inside-avoid">
                    <h3 class="ml-2 text-lg font-semibold break-after-avoid-page">Teilnehmer*in</h3>
                    <table class="table table-bordered mb-5">
                        <tbody>
                        <tr>
                            <td>Name</td><td>{{ $firstname }} {{ $lastname }}</td>
                        </tr>
                        <tr>
                            <td>Geburtstag</td><td>{{ $birthday }}</td>
                        </tr>
                        <tr>
                            <td>Geschlecht</td><td>{{ $gender }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="break-inside-avoid">
                    <h3 class="ml-2 text-lg font-semibold break-after-avoid-page">Gruppe</h3>
                    <table class="table table-bordered mb-5">
                        <tbody>
                        <tr>
                            <td>Stamm</td><td>{{ $stamm }}</td>
                        </tr>
                        <tr>
                            <td>Stufe</td><td>{{ $stufe }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                @if($stufe == 'leiter')
                    <div class="break-inside-avoid">
                        <h3 class="ml-2 text-lg font-semibold break-after-avoid-page">Für Leitende</h3>
                        <table class="table table-bordered mb-5">
                            <tbody>
                            <tr>
                                <td>Rolle/Aufgabe</td><td>{{ $role }}</td>
                            </tr>
                            <tr>
                                <td>Ich habe eine Präventionsschulung (Modul 2d + 2e) besucht</td><td>{{ $prevention }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                @endif

                <div class="break-inside-avoid">
                    <h3 class="ml-2 text-lg font-semibold break-after-avoid-page">Email</h3>
                    <table class="table table-bordered mb-5">
                        <tbody>
                        <tr>
                            <td>Bitte schickt wichtige Infos zum Lager an folgende Email-Adresse:</td><td>{{ $mail }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="break-inside-avoid">
                    <h3 class="ml-2 text-lg font-semibold break-after-avoid-page">Krankenversicherung</h3>
                    <table class="table table-bordered mb-5">
                        <tbody>
                        <tr>
                            <td>Name des/der Hauptversicherten (über wen versichert?):</td><td>{{ $insurance_person }}</td>
                        </tr>
                        <tr>
                            <td>Krankenversicherung:</td><td>{{ $insurance }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="break-inside-avoid">
                    <h3 class="ml-2 text-lg font-semibold break-after-avoid-page">Impfungen</h3>
                    <table class="table table-bordered mb-5">
                        <tbody>
                        <tr>
                            <td colspan="2">// Empfehlung Tetanus, Zecken!</td>
                        </tr>
                        <tr>
                            <td colspan="2">// Corona Impfung ggf. erforderlich zur Teilnahme, je nach Regelung im Sommer.</td>
                        </tr>
                        <tr>
                            <td><label for="vaccination_info_confirmed">Ich habe die obenstehenden Hinweise zum Thema Impfung gelesen und verstanden</label></td><td><input type="checkbox" id="vaccination_info_confirmed" checked="{{ $vaccination_info_confirmed }}" /></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="break-inside-avoid">
                    <h3 class="ml-2 text-lg font-semibold break-after-avoid-page">Ernährung</h3>
                    <table class="table table-bordered mb-5">
                        <tbody>
                        <tr>
                            <td>Ernährung:</td><td>{{ $food }}</td>
                        </tr>
                        <tr>
                            <td>Allergien oder Unverträglichkeiten:</td><td>{{ $allergies }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                @if(!$isOver18)
                    <div class="break-inside-avoid">
                        <h3 class="ml-2 text-lg font-semibold break-after-avoid-page">Kontaktdaten der Erziehungsberechtigten</h3>
                        <table class="table table-bordered mb-5">
                            <tbody>
                            <tr>
                                <td>Telefon:</td><td>{{ $parent_phone }}</td>
                            </tr>
                            <tr>
                                <td>Handy:</td><td>{{ $parent_mobile }}</td>
                            </tr>
                            <tr>
                                <td>Anschrift (während des Lagers):</td><td>{{ $parent_address }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                @endif

                <div class="break-inside-avoid">
                    <h3 class="ml-2 text-lg font-semibold break-after-avoid-page">Vereinbarung über die Nutzung von Fotografien und Filmen</h3>
                    <table class="table table-bordered mb-5">
                        <tbody>
                        <tr>
                            <td colspan="2">
                                Zwischen dem Bezirk München-Ost der Deutschen Pfadfinderschaft Sankt Georg (DPSG) und o.g. Person (bzw. deren Erziehungsberechtigten) wird folgende Nutzungsvereinbarung für Fotografien und Videos getroffen:
                                <ol class="pl-8 list-decimal">
                                    <li>Es wird zugestimmt, dass von der o.g. Person Aufnahmen erstellt und dem Bezirk München-Ost unentgeltlich zum Zwecke der Berichterstattung in Medien, zur Werbung und zur Verwendung nach Ziffer 2 zur Verfügung gestellt werden.</li>
                                    <li>Für die Nutzung wird keine inhaltliche, zeitliche oder räumliche Beschränkung vereinbart. Der Nutzung für folgende Zwecke wird uneingeschränkt zugestimmt:
                                        <ul class="pl-8 list-disc">
                                            <li>Veröffentlichung in den Medien des Bezirks und der Stämme (z.B. Zeitschrift, Newsletter)</li>
                                            <li>Veröffentlichung in der Presse (z.B. Pressefotos)</li>
                                            <li>Veröffentlichung im Internet (z.B. auf den Homepages des Verbandes oder den Auftritten des Verbandes bei Facebook, YouTube, Twitter etc.)</li>
                                        </ul>
                                    </li>
                                    <li>Die/der Fotografierte/Gefilmte stimmt einer Nutzung ihres/seines Fotos/Films zur Nutzung innerhalb von Fotomontagen unter Entfernung oder Ergänzung von Bildbestandteilen bzw. für verfremdete Bilder (keine Entstellung) der Originalaufnahmen zu.</li>
                                    <li>Ein Anspruch auf eine Nutzung im Sinne der Ziffern 1 und 2 wird durch diese Vereinbarung nicht begründet. Der/die Fotografierte/Gefilmte kann beim Bezirk München-Ost die Art der Bild-Nutzung jederzeit erfragen.</li>
                                    <li>Die/der Fotografierte/Gefilmte überträgt dem Fotografen alle zur Ausübung der Nutzung gem. Ziffer 2 notwendigen Rechte an den erstellten Fotografien und Filmen.</li>
                                    <li>Der Name der/des Fotografierten/Gefilmten wird im Sinne des Datenschutzes nicht veröffentlicht. Eine Weitergabe zum Zwecke der Markt- und Meinungsforschung findet nicht statt.</li>
                                    <li>Ein Honorar für die Fotografien und Filme wird nicht gezahlt.</li>
                                    <li>Eine Veränderung an dieser Vereinbarung bedarf der Schriftform.</li>
                                </ol>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="foto_consent_confirmed">Mit meiner Unterschrift akzeptiere ich die obenstehende Vereinbarung über die Nutzung von Fotografien und Filmen</label></td><td><input type="checkbox" id="foto_consent_confirmed" checked="{{ $foto_consent_confirmed }}" /></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="break-inside-avoid">
                    <h3 class="ml-2 text-lg font-semibold break-after-avoid-page">Unterschrift Teilnehmer*in</h3>
                    <table class="table table-bordered mb-2 break-before-avoid">
                        <tbody>
                        <tr>
                            <td class="content-end"><span class="text-xs text-gray-300">Ort, Datum</span></td>
                            <td class="content-end"><span class="text-xs text-gray-300">Unterschrift</span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>


                @if(!$isOver18)
                    <div class="break-inside-avoid">
                        <h3 class="ml-2 text-lg font-semibold break-after-avoid-page">Unterschrift Erziehungsberechtigte*r</h3>
                        <table class="table table-bordered mb-2 break-before-avoid">
                            <tbody>
                            <tr>
                                <td class="content-end"><span class="text-xs text-gray-300">Ort, Datum</span></td>
                                <td class="content-end"><span class="text-xs text-gray-300">Unterschrift</span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </td>
    </tr>
    </tbody>

</table>

</body>

</html>