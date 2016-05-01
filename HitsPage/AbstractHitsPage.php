<?php

namespace HitsBundle\HitsPage;


use HitsBundle\Extractor\ParserInterface;

abstract class AbstractHitsPage implements HitsPageInterface
{
	private $url;
	private $extractor;

	public function __construct($url, ParserInterface $extractor)
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
	 * @return ParserInterface
	 */
	public function getExtractor()
	{
		return $this->extractor;
	}

}