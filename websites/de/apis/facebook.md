# Facebook Scraper API

Das Team hinter PHP Scraper arbeitet an der Bereitstellung kommerzieller APIs für verschiedene gängige Anwendungsfälle und Plattformen. Diese APIs sollen nicht selbst gehostet werden und werden auf einer Pay-as-you-use-Basis bereitgestellt.

Für Facebook erwägen wir die Implementierung einer API mit folgendem Umfang.

## Vorgeschlagene unterstützte Endpunkte

- Benutzer: Öffentliches Benutzerprofil
- Benutzer: Andere soziale Konten
- Benutzer: Freundesliste
- Benutzer: Bilder
- Benutzer: Standortbeiträge
- Benutzer: Benutzerbeiträge
- öffentliche Gruppen und private Gruppen mit Schlüssel: Öffentliches Gruppenprofil
- öffentliche Gruppen und private Gruppen mit Schlüssel: Mitgliederliste
- öffentliche Gruppen und private Gruppen mit Schlüssel: Bilder
- öffentliche Gruppen und private Gruppen mit Schlüssel: Standort Beiträge
- öffentliche Gruppen und private Gruppen mit Schlüssel: Beiträge
- Beitrag: Öffentliche Beitragsdetails (inkl. Kommentare, Likes, Likers, etc.)

Bitte beachten Sie, dass diese Angaben nicht endgültig sind und sich noch ändern können.

## Plattform-Unterstützung

Mit dem Ansatz, eine verwaltete API zu verwenden, müssen sich die Nutzer keine Gedanken mehr über rotierende Proxys, Skalierungsprobleme und Ausfälle machen. Außerdem wird eine breite Palette von Plattformen unterstützt. Sie können problemlos in NodeJS, Python (ohne Requests oder Beautifulsoap), Golang usw. integriert werden. Jede Plattform, die es erlaubt, GET-Anfragen auszuführen, kann so programmiert werden, dass sie Daten von diesem Dienst abruft.
