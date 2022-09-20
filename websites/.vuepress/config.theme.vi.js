module.exports = {
    selectText: '🇻🇳',
    label: 'Tiếng Việt',
    ariaLabel: 'Ngôn ngữ',
    editLinkText: 'Chỉnh sửa trang này trên GitHub',
    lastConfig: 'Cập nhật lần cuối',
    serviceWorker: {
        updatePopup: {
            message: "Nội dung mới có sẵn.",
            buttonText: "Tải lại"
        }
    },
    sidebar: [
        {
            title: '<head>',
            collapsable: false,
            children: [
                'vi/examples/scrape-website-title',
                'vi/examples/scrape-header-tags',
                'vi/examples/scrape-meta-tags',
                'vi/examples/scrape-social-media-meta-tags',
            ],
        },
        {
            title: '<body>',
            collapsable: false,
            children: [
                'vi/examples/headings',
                'vi/examples/paragraphs',
                'vi/examples/lists',
                'vi/examples/outline',
                'vi/examples/extract-keywords',
                'vi/examples/scrape-images',
                'vi/examples/scrape-links',
                'vi/examples/navigation',
            ],
        },
        // {
        //     title: 'APIs',
        //     collapsable: false,
        //     children: [
        //         'apis/alibaba',
        //         'apis/amazon',
        //         'apis/facebook',
        //         'apis/etsy',
        //         'apis/instagram',
        //         'apis/linkedin',
        //         'apis/target',
        //         'apis/tiktok',
        //         'apis/walmart',
        //         'apis/zalando',
        //     ],
        // },
        {
            title: 'MISC',
            collapsable: false,
            children: [
                'vi/misc/sponsors',
                'vi/misc/tutorials',
                'vi/misc/show-case',
                'vi/misc/support',
            ],
        },
    ]
}
