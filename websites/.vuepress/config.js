module.exports = {
  dest: 'dist/',
  title: 'PHP Scraper - An opinionated web-scraping library for PHP',
  description: 'PHP Scraper is providing a simpler way to fetch and parse websites using PHP.',

  plugins: {
    'seo': {},
    'web-monetization': { address: '$ilp.uphold.com/DrRw6MnEEqBB' },
    'minimal-analytics': { ga: 'UA-85277681-13' },
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
      fallbackImage: 'https://api.imageee.com/bold?text=PHPScraper:%20an%20highly%20opinionated%20web-interface&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7',
      autoQuote: true,
      isPlain: true,
    },
  },
  serviceWorker: true,

  themeConfig: {
    domain: 'https://phpscraper.de',
    repo: 'spekulatius/phpscraper',
    docsDir: 'websites',
    editLinks: true,
    lastConfig: 'Last updated',
    serviceWorker: {
      updatePopup: true,
    },
    smoothScroll: true,
    sidebar: [
      {
        title: 'Basics',
        collapsable: false,
        children: [
          'basics/installation',
        ],
      },
      {
        title: 'Header',
        collapsable: false,
        children: [
          'examples/scrape-website-title',
          'examples/scrape-header-tags',
          'examples/scrape-meta-tags',
          'examples/scrape-social-media-meta-tags',
        ],
      },
      {
        title: 'Content',
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
        title: 'Support and More',
        collapsable: true,
        children: [
          'support/more-examples',
          'support/support',
        ],
      },
    ]
  }
};
