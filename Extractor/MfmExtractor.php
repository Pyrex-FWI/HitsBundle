<?php

namespace HitsBundle\Extractor;

use HitsBundle\Item;
use Symfony\Component\DomCrawler\Crawler;

class MfmExtractor extends AbstractParser
{

	/** @return Item[] */
	public function parse($url)
	{
		$data = $this->getContentData($url);
		$data = html_entity_decode($data);
		$crawler = new Crawler($data);
		$crawler = $crawler->filter('h3.stitle');
		$nbItem = $crawler->count();
		$results = [];
		for ($i = 0; $i < $nbItem; $i++ ) {
			$line = $crawler->eq($i)->text();
			$dataUid = crc32($line);
			preg_match('/^\d{2}\s+.\s+(?<artist>[\w\s\-\’]*\w)([»«\s\–]*)?(?<title>[\w\s\-\’]*\w)([»«\s\–]*)$/u', $line, $match);
			$parts = array_map('trim', $match);
			if (isset($parts['artist']) && isset($parts['title'])) {
				$results[] = (new Item())->setArtist(ucwords($parts['artist']))->setTitle(ucwords($parts['title']))->setUid($dataUid);
			} else {
				$results[] = (new Item())->setLongTitle($line)->setProperlyDecoded(false)->setUid($dataUid);
			}
		}
		return $results;
	}
}