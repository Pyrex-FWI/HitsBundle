<?php

namespace RadioHitsBundle\Extractor;

use RadioHitsBundle\Item;
use Symfony\Component\DomCrawler\Crawler;

class MfmExtractor extends AbstractExtractor
{

	/** @return Item[] */
	public function extract()
	{
		$data = $this->getContentData($this->url);
		$data = html_entity_decode($data);
		$crawler = new Crawler($data);
		$crawler = $crawler->filter('h3.stitle');
		$nbItem = $crawler->count();

		for ($i = 0; $i < $nbItem; $i++ ) {
			preg_match('/^\d{2}\s+.\s+(?<artist>[\w\s\-\’]*\w)([»«\s\–]*)?(?<title>[\w\s\-\’]*\w)([»«\s\–]*)$/u', $crawler->eq($i)->text(), $match);
			$line = array_map('trim', $match);
			$results[] = (new Item())->setArtist($line['artist'])->setTitle($line['title']);
		}

		return $results;
	}
}