<?php

namespace RadioHitsBundle\HitsPage;


use RadioHitsBundle\Extractor\ExtractorInterface;

abstract class AbstractHitsPage implements HitsPageInterface
{
	private $url;
	private $extractor;

	public function __construct($url, ExtractorInterface $extractor)
	{
		$this->url = $url;
		$this->extractor = $extractor;
	}

	/**
	 * @return mixed
	 */
	public function getUrl()
	{
		return $this->url;
	}

	/**
	 * @return mixed
	 */
	public function getExtractor()
	{
		return $this->extractor;
	}

}