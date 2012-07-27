#!/usr/bin/php5
<?php
	$rssdir = dirname(__FILE__);
	chdir($rssdir);
	$content = file_get_contents('tmp.mail');
	if ($content) {
		mail('debaernd+rss@debaernd.de', 'RSS Treffer', $content);
		file_put_contents('tmp.mail', '');
		echo file_get_contents('tmp.mail');
	}
