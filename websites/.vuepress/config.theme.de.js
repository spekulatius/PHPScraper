module.exports = {
    selectText: '🇺🇳️',
    label: 'Deutsch',
    ariaLabel: 'Sprachen',
    editLinkText: 'Diese Seite auf GitHub bearbeiten',
    lastConfig: 'Zuletzt aktualisiert',
    serviceWorker: {
        updatePopup: {
            message: "Neue Inhalte sind verfügbar.",
            buttonText: "Aktualisieren"
        }
    },
    sidebar: [
        {
            title: '<head>',
            collapsable: false,
            children: [
                'de/examples/scrape-website-title',
                'de/examples/scrape-header-tags',
                'de/examples/scrape-meta-tags',
                'de/examples/scrape-social-media-meta-tags',
            ],
        },
        {
            title: '<body>',
            collapsable: false,
            children: [
                'de/examples/headings',
                'de/examples/paragraphs',
                'de/examples/lists',
                'de/examples/outline',
                'de/examples/extract-keywords',
                'de/examples/scrape-images',
                'de/examples/scrape-links',
                'de/examples/navigation',
            ],
        },
        {
            title: 'APIs',
            collapsable: false,
            children: [
                'de/apis/alibaba',
                'de/apis/amazon',
                'de/apis/facebook',
                'de/apis/etsy',
                'de/apis/instagram',
                'de/apis/linkedin',
                'de/apis/target',
                'de/apis/tiktok',
                'de/apis/walmart',
                'de/apis/zalando',
            ],
        },
        {
            title: 'usw',
            collapsable: false,
            children: [
                'de/misc/sponsors',
                'de/misc/tutorials',
                'de/misc/show-case',
                'de/misc/support',
            ],
        },
    ]
}
