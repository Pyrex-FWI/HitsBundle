<?php

namespace RadioHitsBundle\Extractor;

use RadioHitsBundle\Item;
use Symfony\Component\DomCrawler\Crawler;

class Extractor extends AbstractExtractor
{

	/** @return Item */
	public function extract($url)
	{
		$data = $this->getContentData($url);
		$crawler = new Crawler(null, $data);
	}
}