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
		$this->client = new Client(
				[
						'http_errors' => false,
						'cookies' 	=> true,
						'headers' 	=> [
								'User-Agent' => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.157 Safari/537.36",
						],
						'allow_redirect' => true,
						'debug' 	=> false
				]
		);
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