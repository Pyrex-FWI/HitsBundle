<?php

namespace RadioHitsBundle\HitsPage;


interface HitsPageInterface
{
	/** @return string */
	public function getUrl();
	public function getExtractor();
}