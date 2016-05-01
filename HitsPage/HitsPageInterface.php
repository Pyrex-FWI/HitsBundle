<?php

namespace HitsBundle\HitsPage;


use HitsBundle\Extractor\Extractor;

interface HitsPageInterface
{
	/** @return string */
	public function getUrl();
	/** @return \HitsBundle\Extractor\ParserInterface */
	public function getExtractor();
}