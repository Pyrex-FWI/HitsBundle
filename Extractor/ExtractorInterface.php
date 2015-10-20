<?php

namespace RadioHitsBundle\Extractor;

use RadioHitsBundle\Item;

interface ExtractorInterface
{
	/** @return Item */
	public function extract($url);
}