#!/usr/bin/php5
<?php
	$rssdir = dirname(__FILE__);
	chdir($rssdir);
	$output = file_get_contents('tmp.mail');

	$rss_sources = json_decode(file_get_contents('sources.json'), true);
	foreach($rss_sources as $source) {
		$content = file_get_contents($source['url']);
		$xml = simplexml_load_string($content);
		foreach($xml->channel->item as $item) {
			$content = strip_tags(html_entity_decode((string) $item->description));
			$id = md5($content);
			if (!file_exists('./archive/' . $id)) {
				file_put_contents('./archive/' . $id, ((string) $item->link) . "\n" . ((string) $item->title) . "\n" . $content);
				$ret = preg_match('/(windkraft|kita|Landesgartenschau|Aartalbahn|Versorgungsnetz|Blockheizkraftwerk|BHKW|Photovoltaik|Subventionen|Kreisverwaltung|ÖPNV|RTV|Energie|Partei|Bürgerinitiative|Jugend|Sozialpolitik|Arbeitsrecht|Jobcenter|ALG II|Fallmanager|GBW|Bauhaus|Domäne Mechthildshausen|Grundsicherung|Sanktionen|Regelbedarf|Sozialgericht|Zeitarbeit|Bürgerarabeit|Ein-Euro-Jobs|Eingliederungsvereinbarungen|Private Arbeitsvermittler|Bedinungsloses Grundeinkommen|BGE|Arbeitslosenstatistik|Hartz IV|Sozialgesetzbuch|SGB|Erwerblosen-Beratung|maut|autobahnähnlich)/mi', $content, $pat);
				if ($ret) {
					$output = $output . $source['name'] . ' ' . $pat[1] . ' ' . ((string) $item->link) . "\n";
				}
			}
		}
	}
	
	file_put_contents('tmp.mail', $output);
