# Facebook Scraper API

Das Team hinter PHP Scraper arbeitet daran, kommerzielle APIs für verschiedene gängige Anwendungsfälle und Plattformen bereitzustellen. Diese APIs werden nicht selbst gehostet. Sie müssen sich keine Gedanken über rotierende IPs/Proxies machen und einen Headless-Browser wie Puppeteer verwenden. Mit einem einfachen API-Aufruf erhalten Sie alle erforderlichen Informationen. Die Dienste werden auf der Grundlage einer attraktiven, nutzungsabhängigen Gebührenstruktur bereitgestellt.

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

::: tip
Bitte beachten Sie, dass diese Liste der API-Endpunkte *nicht* endgültig ist und sich wahrscheinlich noch ändern wird.
:::

## Plattform-Unterstützung

Mit dem Ansatz, eine verwaltete API zu verwenden, müssen sich die Nutzer keine Gedanken mehr über rotierende Proxys, Skalierungsprobleme und Ausfälle machen. Außerdem wird eine breite Palette von Plattformen unterstützt. Sie können problemlos in NodeJS, Python (ohne Requests oder Beautifulsoap), Golang usw. integriert werden. Jede Plattform, die es erlaubt, GET-Anfragen auszuführen, kann so programmiert werden, dass sie Daten von diesem Dienst abruft.
