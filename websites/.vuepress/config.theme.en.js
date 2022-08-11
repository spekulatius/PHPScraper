module.exports = {
    selectText: '🇺🇳️',
    label: 'English',
    ariaLabel: 'Languages',
    editLinkText: 'Edit this page on GitHub',
    lastConfig: 'Last updated',
    serviceWorker: {
        updatePopup: {
            message: "New content is available.",
            buttonText: "Refresh"
        }
    },
    sidebar: [
        {
            title: '<head>',
            collapsable: false,
            children: [
                'examples/scrape-website-title',
                'examples/scrape-header-tags',
                'examples/scrape-meta-tags',
                'examples/scrape-social-media-meta-tags',
            ],
        },
        {
            title: '<body>',
            collapsable: false,
            children: [
                'examples/headings',
                'examples/paragraphs',
                'examples/lists',
                'examples/outline',
                'examples/extract-keywords',
                'examples/scrape-images',
                'examples/scrape-links',
                'examples/navigation',
            ],
        },
        {
            title: 'APIs',
            collapsable: false,
            children: [
                'apis/alibaba',
                'apis/amazon',
                'apis/facebook',
                'apis/instagram',
                'apis/linkedin',
                'apis/tiktok',
                'apis/walmart',
                'apis/zalando',
            ],
        },
        {
            title: 'MISC',
            collapsable: true,
            children: [
                'support/more-examples',
                'support/support',
            ],
        },
    ]
}
