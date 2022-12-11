<?php

require __DIR__.'/vendor/autoload.php';

// ENTER YOUR URL HERE:
$url = 'http://github.com/spekulatius/PHPScraper';
echo 'requesting ', $url, "\n";
$web = new \Spekulatius\PHPScraper\PHPScraper();
$web->go($url);
//var_dump($web->client);

if ($web->currentUrl !== $url) {
    echo 'redirected to ', $web->currentUrl, "\n";
}
echo 'status code ', $web->statusCode, "\n";

if ($web->isGone) {
    echo "delete/deactivate record from database\n";
} else {
    if ($web->permanentRedirectUrl !== '') {
        echo 'url changed - update url in database to ', $web->permanentRedirectUrl, "\n";
    }

    $retryAt = $web->retryAt;
    if ($web->isSuccess) {
        echo "got data successfully - process it now...\n";
    } elseif ($web->isTemporaryResult) {
        echo "temporary error\n";
        if (!$retryAt) {
            $retryAt = time() + 15*60;
        }    // FIXME: use longer times if we get the same status code multiple times
    } else {
        echo "might be a permanent error - but who knows if the server changes its mind (e.g. if the result is caused by some administrative work on the server) --> try several times before considering it final\n";
        if (!$retryAt) {
            $retryAt = time() + 24*60*60;
        }    // FIXME: use longer times if we get the same status code multiple times  OR  consider it somewhen really permanent and delete/deactivate record from database
    }
    if ($retryAt) {
        echo 'retry at ', date('Y-m-d H:i:s', $retryAt), "\n";
    }
}
