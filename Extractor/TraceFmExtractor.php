<?php

namespace HitsBundle\Extractor;

use HitsBundle\Item;
use Symfony\Component\DomCrawler\Crawler;

class TraceFmExtractor extends AbstractParser
{

	/** @return Item[] */
	public function parse($url)
	{
		$data = $this->getContentData($url);
		$data = str_replace('<br />', ' - ', $data);
		$data = html_entity_decode($data);

		$crawler = new Crawler($data);
		$crawler = $crawler->filter('div.hit_titre');
		$nbItem = $crawler->count();
		$results = [];
		for ($i = 0; $i < $nbItem; $i++ ) {
			$dataUid = $crawler->eq($i)->text();
			$line = array_map('trim', explode('-', mb_convert_encoding($crawler->eq($i)->text(), 'ISO-8859-1'),2));

			$item = (new Item())->setArtist(ucwords($line[0]))->setTitle(ucwords($line[1]))->setUid($dataUid);
			$results[] = $item;
            $this->dispatchItem($item);
        }

		return $results;
	}
}