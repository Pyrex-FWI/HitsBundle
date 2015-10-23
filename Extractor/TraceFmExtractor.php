<?php

namespace RadioHitsBundle\Extractor;

use RadioHitsBundle\Item;
use Symfony\Component\DomCrawler\Crawler;

class TraceFmExtractor extends AbstractExtractor
{

	/** @return Item[] */
	public function extract()
	{
		$data = $this->getContentData($this->url);
		$data = str_replace('<br />', ' - ', $data);
		$data = html_entity_decode($data);

		$crawler = new Crawler($data);
		$crawler = $crawler->filter('div.hit_titre');
		$nbItem = $crawler->count();

		for ($i = 0; $i < $nbItem; $i++ ) {
			$line = array_map('trim', explode('-', mb_convert_encoding($crawler->eq($i)->text(), 'ISO-8859-1'),2));
			$results[] = (new Item())->setArtist(ucwords($line[0]))->setTitle(ucwords($line[1]));
		}

		return $results;
	}
}