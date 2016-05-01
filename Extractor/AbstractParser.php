<?php

namespace HitsBundle\Extractor;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use HitsBundle\Event\HitsBundleEvent;
use HitsBundle\Event\SourceEvent;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Symfony\Component\EventDispatcher\EventDispatcher;

abstract class AbstractParser implements ParserInterface
{
	/** @var  ClientInterface */
	private $client;
	/** @var  EventDispatcher */
	private $eventDispatcher;
	/** @var  LoggerInterface */
	private $logger;

	public function __construct($eventDispatcher, $logger)
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
		$this->eventDispatcher = $eventDispatcher;
		$this->logger = $logger ? $logger : new NullLogger();
	}


	/**
	 * @return string
	 */
	public function getContentData($url)
	{

		return $this->client->get($url)->getBody()->__toString();
	}

	public function extract($url)
	{
		$result = $this->parse($url);
		$this->logger->info(sprintf('Grab url: %s', $url), [count($result)]);
		$sourceEvent = new SourceEvent($this, $result);
		$this->eventDispatcher->dispatch(HitsBundleEvent::ITEMS_POST_EXTRACT, $sourceEvent);

		return $result;
	}

	abstract public function parse($url);



}