<?php

namespace RadioHitsBundle\Extractor;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

abstract class AbstractExtractor implements ExtractorInterface
{
	/** @var  ClientInterface */
	private $client;
	protected $url;

	public function __construct()
	{
		$this->client = new Client(['allow_redirect' => true, 'debug' => false]);
	}

	/**
	 * @param mixed $url
	 * @return AbstractExtractor
	 */
	public function setUrl($url)
	{
		$this->url = $url;
		return $this;
	}
	/**
	 * @param $url
	 * @return string
	 */
	public function getContentData($url)
	{
		return $this->client->get($url)->getBody()->__toString();
	}

}