<?php

namespace HitsBundle\Extractor;

use HitsBundle\Item;
use Symfony\Component\DomCrawler\Crawler;

class DeezerParser extends AbstractParser
{

	/** @return Item[] */
	public function parse($url)
	{
		$data = json_decode($this->getContentData($url), true);
		$items = [];
		foreach ($data['tracks']['data'] as $track) {
			$dataUid = crc32(json_encode($track));
			$item = (new Item())->setArtist(ucwords($track['title']))->setTitle(ucwords($track['artist']['name']))->setUid($dataUid);
			$items[] = $item;
		}

		return $items;
	}

}