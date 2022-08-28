module.exports = {
    selectText: '🇺🇳️',
    label: 'Español',
    ariaLabel: 'Idiomas',
    editLinkText: 'Editar esta página en GitHub',
    lastConfig: 'Última actualizado',
    serviceWorker: {
        updatePopup: {
            message: "Hay nuevos contenidos disponibles.",
            buttonText: "Actualizar"
        }
    },
    sidebar: [
        {
            title: '<head>',
            collapsable: false,
            children: [
                'es/examples/scrape-website-title',
                'es/examples/scrape-header-tags',
                'es/examples/scrape-meta-tags',
                'es/examples/scrape-social-media-meta-tags',
            ],
        },
        {
            title: '<body>',
            collapsable: false,
            children: [
                'es/examples/headings',
                'es/examples/paragraphs',
                'es/examples/lists',
                'es/examples/outline',
                'es/examples/extract-keywords',
                'es/examples/scrape-images',
                'es/examples/scrape-links',
                'es/examples/navigation',
            ],
        },
        {
            title: 'APIs',
            collapsable: false,
            children: [
                'es/apis/alibaba',
                'es/apis/amazon',
                'es/apis/facebook',
                'es/apis/instagram',
                'es/apis/linkedin',
                'es/apis/tiktok',
                'es/apis/walmart',
                'es/apis/zalando',
            ],
        },
        {
            title: 'Apoyo comercial y más',
            collapsable: true,
            children: [
                'es/support/more-examples',
                'es/support/support',
            ],
        },
    ]
}
