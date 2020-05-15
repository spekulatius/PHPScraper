module.exports = {
  dest: 'dist/',
  title: 'PHP Scraper - An oppinated web-scraper library for PHP',
  description: 'PHP Scraper is providing a simpler way to fetch and parse websites using PHP.',

  plugins: {
    'minimal-analytics': { ga: 'UA-85277681-13' },
    'sitemap': { hostname: 'https://phpscraper.de/', changefreq: 'monthly' },
    'seo': {},

    '@vuepress/pwa', {
      serviceWorker: true,
      updatePopup: true
    }
  },
  serviceWorker: true,

  themeConfig: {
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
          'examples/outline',
          'examples/scrape-images',
          'examples/scrape-links',
          'examples/navigation',
        ],
      },
      {
        title: 'Support and More',
        collapsable: true,
        children: [
          'examples/more-examples',
        ],
      },
    ]
  }
};
