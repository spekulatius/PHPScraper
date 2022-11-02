<?php

require __DIR__ . '/vendor/autoload.php';

echo "\n";
echo "#########################\n";
echo "# PHPScraper Playground #\n";
echo "#########################\n";
echo "\n";

$web = new \spekulatius\phpscraper;
var_dump($web->fetchAsset('https://phpscraper.de/sitemap.xml'));





















// $feed = new \SimplePie\SimplePie();
// $feed->set_feed_url('https://hnrss.org/newest?points=300&count=4');
// $feed->enable_cache(false);
// $feed->init();

// $items = $feed->get_items();

// foreach ($items as $item) {
// 	// var_dump($item);
//     echo $item->get_title() . "\n";
// }



// var_dump([

//     $this->filterFirstExtractAttribute('//link[@rel="alternative" @type="application/rss+xml"]', ['href']);
// ]);



// // <!-- Feeds -->
// // <link rel="alternate" href="https://feeds.feedburner.com/example" type="application/rss+xml" title="RSS">
// // <link rel="alternate" href="https://example.com/feed.atom" type="application/atom+xml" title="Atom 0.3">
