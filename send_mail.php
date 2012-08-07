#!/usr/bin/php5
<?php
	$rssdir = dirname(__FILE__);
	$heute = date("d.m.y");
	$betreff = 'RSS Treffer' . ' ' . $heute;
	chdir($rssdir);
	$content = file_get_contents('tmp.mail');
	if ($content) {
		mail('debaernd+rss@debaernd.de', $betreff, $content);
		file_put_contents('tmp.mail', '');
		echo file_get_contents('tmp.mail');
	}
