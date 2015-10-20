<?php

namespace RadioHitsBundle\Extractor;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

abstract class AbstractExtractor implements ExtractorInterface
{
	/** @var  ClientInterface */
	private $client;

	public function __construct()
	{
		$this->client = new Client(['allow_redirect' => true]);
	}

	public function getContentData($url)
	{
		return $this->client->get($url)->getBody()->__toString();
	}
}