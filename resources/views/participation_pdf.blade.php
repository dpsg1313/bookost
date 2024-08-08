<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Lageranmeldung</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
    <style>
        @page {
            margin: 20mm
        }

        @media print {
            .header, .header-space {
                height: 100px;
            }
            .header {
                position: fixed;
                top: 0;
            }
        }
    </style>
</head>

<body>

<div class="header" style="text-align: center">
    <div class="header flex justify-between items-center">
        <img class="inline-flex h-20" src="{{asset('images/München-Ost_Logo2_noBackground.png')}}" alt="Logo DPSG München-Ost" />
        <h2 class="ml-8 inline-flex justify-end text-center mb-3 text-3xl font-bold">Anmeldung zum Bezirkslager 2022</h2>
    </div>
</div>

<table>
    <thead><tr><td>
            <div class="header-space">&nbsp;</div>
        </td></tr></thead>
    <tbody><tr><td>
            <div class="content">
                <table class="table table-bordered mb-5">
                    <tbody>
                    <tr>
                        <td>Zeitraum</td>
                        <td>28. August bis 4. September 2022</td>
                    </tr>
                    <tr>
                        <td>Ort</td>
                        <td>
                            Zeltplatz Bucher Berg<br>
                            in Breitenbrunn (Oberpfalz)
                        </td>
                    </tr>
                    <tr>
                        <td>Teilnahmebeitrag</td>
                        <td>{{ $beitrag }}€</td>
                    </tr>
                    <tr>
                        <td>Bitte überweisen bis spätestens 30. April 2022 an folgende Bankverbindung:</td>
                        <td>Kontoinhaber: {{ $stamm['bankAccountOwner'] }}<br>IBAN: {{ $stamm['iban'] }}<br>BIC: {{ $stamm['bic'] }}</td>
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
                            <td>Geburtstag</td><td>{{ $birthday->format('d.m.Y') }}</td>
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
                            <td>Stamm</td><td>{{ $stamm['name'] }}</td>
                        </tr>
                        <tr>
                            <td>Stufe</td><td>{{ $stufe }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                @if($stufe_id == 'leiter')
                    <div class="break-inside-avoid">
                        <h3 class="ml-2 text-lg font-semibold break-after-avoid-page">Für Leitende</h3>
                        <table class="table table-bordered mb-5">
                            <tbody>
                            <tr>
                                <td>Rolle/Aufgabe</td><td>{{ $role }}</td>
                            </tr>
                            <tr>
                                <td><label for="prevention">Ich habe eine Präventionsschulung (Modul 2d + 2e) besucht</label></td><td><input type="checkbox" id="prevention" {{ $prevention ? ' checked="checked"' : '' }}/></td>
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
                            <td colspan="2">Wir empfehlen die Impfung gegen Tetanus (Wundstarrkrampf) sowie FSME (Zecken) für alle Teilnehmenden des Zeltlagers. Bitte überprüft euren Impfschutz rechtzeitig und sprecht ggf. mit eurem Hausarzt.</td>
                        </tr>
                        <tr>
                            <td><label for="vaccination_info_confirmed">Ich habe die obenstehenden Hinweise zum Thema Impfung gelesen und verstanden</label></td><td><input type="checkbox" id="vaccination_info_confirmed" {{ $vaccination_info_confirmed ? ' checked="checked"' : '' }}/></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="break-inside-avoid">
                    <h3 class="ml-2 text-lg font-semibold break-after-avoid-page">Ernährung</h3>
                    <table class="table table-bordered mb-5">
                        <tbody>
                        <tr>
                            <td>Ernährung:</td><td>{{ $food }}{{ $gluten ? ', glutenfrei' : ''}}{{$lactose ? ', laktosefrei' : ''}}</td>
                        </tr>
                        <tr>
                            <td>Allergien und sonstige Essensbesonderheiten:</td><td>{{ $allergies }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                @if(!$isOver18)
                    <div class="break-inside-avoid">
                        <h3 class="ml-2 text-lg font-semibold break-after-avoid-page">Kontaktdaten eines/einer Erziehungsberechtigten, der/die während des Lagers unter folgenden Kontaktdaten für den Notfall erreichbar ist.</h3>
                        <table class="table table-bordered mb-5">
                            <tbody>
                            <tr>
                                <td>Name:</td><td>{{ $parent_name }}</td>
                            </tr>
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
                            <td><label for="foto_consent_confirmed">Mit meiner Unterschrift akzeptiere ich die obenstehende Vereinbarung über die Nutzung von Fotografien und Filmen</label></td><td><input type="checkbox" id="foto_consent_confirmed" {{ $foto_consent_confirmed ? ' checked="checked"' : '' }}/></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="break-inside-avoid">
                    <h3 class="ml-2 text-lg font-semibold">Unterschrift Teilnehmer*in</h3>
                    <table class="table table-bordered mb-2">
                        <tbody>
                        <tr>
                            <td class="content-end"><span class="text-xs text-gray-300">Ort, Datum</span></td>
                            <td class="content-end"><span class="text-xs text-gray-300">Unterschrift</span></td>
                        </tr>
                        </tbody>
                    </table>

                    @if(!$isOver18)
                        <h3 class="ml-2 text-lg font-semibold">Unterschrift Erziehungsberechtigte*r</h3>
                        <table class="table table-bordered mb-2">
                            <tbody>
                            <tr>
                                <td class="content-end"><span class="text-xs text-gray-300">Ort, Datum</span></td>
                                <td class="content-end"><span class="text-xs text-gray-300">Unterschrift</span></td>
                            </tr>
                            </tbody>
                        </table>
                    @endif
                </div>

                <div class="break-inside-avoid">
                    <table class="table table-bordered mb-2">
                        <tbody>
                        <tr>
                            <td class="content-end">Anmeldung bitte bis spätestens 17. April beim Stamm abgeben!</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </td></tr></tbody>
</table>

</body>

</html>
