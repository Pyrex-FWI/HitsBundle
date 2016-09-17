<?php

namespace HitsBundle\Extractor;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use HitsBundle\Event\HitsBundleEvent;
use HitsBundle\Event\SourceItemCollectionEvent;
use HitsBundle\Event\SourceItemEvent;
use HitsBundle\Item;
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

    /**
     * AbstractParser constructor.
     * @param $eventDispatcher
     * @param $logger
     */
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
     * @param $url
     * @throws \Exception
     * @return string
     */
	public function getContentData($url)
	{
        try {
            return $this->client->get($url)->getBody()->__toString();
        } catch (\Exception $e) {
            new \Exception(sprintf('Error %s, for: %s', $e->getMessage(), $url));
        }
	}

    /**
     * @param $url
     * @return mixed
     */
	public function extract($url)
	{
		$result = $this->parse($url);
		$this->logger->info(sprintf('Grab url: %s', $url), [count($result)]);
		$sourceEvent = new SourceItemCollectionEvent($this, $result);
		$this->eventDispatcher->dispatch(HitsBundleEvent::SOURCE_ITEM_COLLECTION, $sourceEvent);

		return $result;
	}

	protected function dispatchItem(Item $item)
    {
        $sourceEvent = new SourceItemEvent($this, $item);
        $this->eventDispatcher->dispatch(HitsBundleEvent::SOURCE_ITEM, $sourceEvent);
    }

	abstract public function parse($url);



}