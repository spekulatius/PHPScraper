# Instagram Scraper API

Das Team hinter PHP Scraper arbeitet an der Bereitstellung kommerzieller APIs für verschiedene gängige Anwendungsfälle und Plattformen. Diese APIs sollen nicht selbst gehostet werden und werden auf einer Pay-as-you-use-Basis bereitgestellt.

Für Instagram erwägen wir die Implementierung einer API mit folgendem Umfang.

## Vorgeschlagene unterstützte Endpunkte

- Benutzer: Profil Details
- Benutzer: Highlights
- Benutzer: Beiträge
- Benutzer: Getaggte Beiträge
- Benutzer: Öffentliche Beiträge
- Benutzer: Follower
- Benutzer: Geschichten erhalten
- Benutzer: Aktueller Status
- Benutzer: Andere soziale Konten
- Öffentliche Beiträge: Kommentare
- Öffentlicher Beitrag: Likers
- Story-Downloader mit Konvertierung in mp4, mp3, etc.
- Hashtag-Beiträge
- Standort-Posts
- Standort-Suche
- Details zum Beitrag
- Verwandte Profile
- Suche

Bitte beachten Sie, dass diese Angaben nicht endgültig sind und sich noch ändern können.

## Plattform-Unterstützung

Mit dem Ansatz, eine verwaltete API zu verwenden, müssen sich die Nutzer keine Gedanken mehr über rotierende Proxys, Skalierungsprobleme und Ausfälle machen. Außerdem wird eine breite Palette von Plattformen unterstützt. Sie können problemlos in NodeJS, Python (ohne Requests oder Beautifulsoap), Golang usw. integriert werden. Jede Plattform, die es erlaubt, GET-Anfragen auszuführen, kann so programmiert werden, dass sie Daten von diesem Dienst abruft.
