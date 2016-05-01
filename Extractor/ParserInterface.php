<?php

namespace HitsBundle\Extractor;

use HitsBundle\Item;

interface ParserInterface
{
	/** @return Item[] */
	public function extract($url);

}