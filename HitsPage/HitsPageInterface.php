<?php

namespace RadioHitsBundle\HitsPage;


use RadioHitsBundle\Extractor\Extractor;

interface HitsPageInterface
{
	/** @return string */
	public function getUrl();
	/** @return \RadioHitsBundle\Extractor\ExtractorInterface */
	public function getExtractor();
}