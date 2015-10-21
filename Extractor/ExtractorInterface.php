<?php

namespace RadioHitsBundle\Extractor;

use RadioHitsBundle\Item;

interface ExtractorInterface
{
	/** @return Item */
	public function extract();

	/**
	 * @param string $url
	 * @return mixed
	 */
	public function setUrl($url);
}