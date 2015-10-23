<?php

namespace RadioHitsBundle\Extractor;

use RadioHitsBundle\Item;
use Symfony\Component\DomCrawler\Crawler;

class NrjAntillesHitsExtractor extends AbstractExtractor
{

	/** @return Item[] */
	public function extract()
	{
		$data = $this->getContentData($this->url);
		$data = html_entity_decode($data);
		$crawler = new Crawler($data);
		$first = array_map('trim', explode('-', mb_convert_encoding($crawler->filter('div.first_hit > div.topthumb-cont > h2')->eq(0)->text(), 'ISO-8859-1'), 2));
		$results[] = (new Item())->setArtist(ucwords($first[0]))->setTitle(ucwords($first[1]));
		$crawler = $crawler->filter('div.txt_hit_suite > a.hit_titre');
		$nbItem = $crawler->count();
		for ($i = 0; $i < $nbItem; $i++ ) {
			$line = array_map('trim', explode('  ', mb_convert_encoding($crawler->eq($i)->text(), 'ISO-8859-1'),2));
			$results[] = (new Item())->setArtist(ucwords($line[0]))->setTitle(ucwords($line[1]));
		}

		return $results;
	}
}