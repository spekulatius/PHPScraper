const fs = require('fs')
const path = require('path')

module.exports = {
    dest: 'dist/',
    title: 'PHP Scraper: Bringing Simplicity back to Scraping and Crawling',
    description: 'PHP Scraper is providing a simpler way to fetch and parse websites using PHP.',

    plugins: {
        'seo': {},
        'web-monetization': { address: '$ilp.uphold.com/DrRw6MnEEqBB' },
        'umami': { trackerUrl: 'https://u.peterthaleikis.com', siteId: '5ee0a886-020d-4fd9-99f1-201ef2691cf6' },
        'canonical': { baseURL: 'https://phpscraper.de' },
        'sitemap': { hostname: 'https://phpscraper.de/', changefreq: 'monthly' },

        '@vuepress/pwa': {
            serviceWorker: true,
            updatePopup: false
        },
        '@vuepress/plugin-back-to-top': {},

        'social-share': {
            networks: ['telegram', 'line', 'twitter', 'reddit'],
            twitterUser: 'spekulatius1984',
            fallbackImage: 'https://api.imageee.com/bold?text=PHP%20Scraper:%20Bringing%20Simplicity%20back%20to%20Scraping%20and%20Crawling&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7',
            autoQuote: true,
            isPlain: true,
        },
    },
    serviceWorker: true,

    locales: {
        '/': {
            lang: 'en-US',
            title: 'PHP Scraper: Bringing Simplicity back to Scraping and Crawling',
            description: 'PHP Scraper is providing a fuss-free way to scrape and crawl websites using PHP.'
        },
        '/de/': {
            lang: 'de',
            title: 'PHP Scraper: Scraping und Crawling einfach gemacht',
            description: 'PHP Scraper: Scraping, Crawling und Daten Sammeln einfach gemacht.'
        },
        '/es/': {
            lang: 'es',
            title: 'PHP Scraper: La simplicidad en el scraping y el crawling',
            description: 'PHP Scraper proporciona una forma más sencilla de obtener y analizar sitios web utilizando PHP.'
        },
        '/fr/': {
            lang: 'fr',
            title: 'PHP Scraper: Simplifier les opérations de scraping et de crawling',
            description: 'PHP Scraper offre un moyen plus simple de récupérer et d\'analyser des sites web en utilisant PHP.'
        },
        '/vi/': {
            lang: 'vi',
            title: 'PHP Scraper: Đưa sự đơn giản trở lại Thu thập và Cào',
            description: 'PHP Scraper đang cung cấp một cách dễ dàng phân tích và thu thập dữ liệu các trang web bằng PHP.'
        },
    },
    themeConfig: {
        domain: 'https://phpscraper.de',
        repo: 'spekulatius/phpscraper',
        docsDir: 'websites',
        editLinks: true,
        smoothScroll: true,
        locales: {
            '/': {
                ...require('./config.theme.en')
            },
            '/de/': {
                ...require('./config.theme.de')
            },
            '/es/': {
                ...require('./config.theme.es')
            },
            '/fr/': {
                ...require('./config.theme.fr')
            },
            '/vi/': {
                ...require('./config.theme.vi')
            },
        }
    }
};
