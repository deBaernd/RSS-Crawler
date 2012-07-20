#!/usr/bin/php5
<?php
	$output = '';
	$rssdir = dirname(__FILE__);
	chdir($rssdir);

	$rss_sources = json_decode(file_get_contents('sources.json'), true);
	foreach($rss_sources as $source) {
		$content = file_get_contents($source['url']);
		$xml = simplexml_load_string($content);
		foreach($xml->channel->item as $item) {
			$webContent = file_get_contents((string) $item->link);
			$ret = preg_match('/(windkraft|kita)/mi', $webContent, $pat);
			if ($ret) {
				$output = $output . $source['name'] . ' ' . $pat[1] . ' ' . ((string) $item->link) . "\n";
			}
		}
	}

	mail('debaernd+rss@debaernd.de', 'RSS Treffer', $output);

