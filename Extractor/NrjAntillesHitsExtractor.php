<?php

namespace HitsBundle\Extractor;

use HitsBundle\Item;
use Symfony\Component\DomCrawler\Crawler;

class NrjAntillesHitsExtractor extends AbstractParser
{

	/** @return Item[] */
	public function parse($url)
	{
		$data = $this->getContentData($url);
		$data = html_entity_decode($data);

		return array_merge([$this->getFirstHit($data)], $this->getOtherHits($data));
	}

	private function getFirstHit($data)
	{
		$crawler = new Crawler($data);
		$artist = trim(substr(trim($crawler->filter('div.first_hit h2 strong')->text()), 0, -1));
		$title = $this->convertEncoding($crawler->filter('div.first_hit h2 span')->text(), 'ISO-8859-1');

		return (new Item())->setArtist(ucwords($artist))->setTitle(ucwords($title));
	}

	private function getOtherHits($data)
	{
		$crawler = new Crawler($data);
		$crawler = $crawler->filter('a.hit_titre');
		$nbItem = $crawler->count();
		$items = [];
		for ($i = 0; $i < $nbItem; $i++ ) {
			$dataUid = crc32($crawler->eq($i)->text());

			if( $crawler->eq($i)->filter('strong')->count() == 0) {
				$longName = $this->convertEncoding($crawler->eq($i)->text());
				$item = (new Item())->setProperlyDecoded(false)->setLongTitle($longName)->setUid($dataUid);
				$items[] = $item;
			}
			if ($crawler->eq($i)->filter('strong')->count()) {
				$artist = ($this->convertEncoding(trim($crawler->eq($i)->filter('strong')->text())));
				$title = ($this->convertEncoding(trim($crawler->eq($i)->filter('span')->text())));
				$item = (new Item())->setArtist(ucwords($artist))->setTitle(ucwords($title))->setUid($dataUid);
				$items[] = $item;
			}
		}

		return $items;
	}

	private function convertEncoding($text, $encoding = 'ISO-8859-1') {

		return mb_convert_encoding(trim($text), $encoding);
	}
}