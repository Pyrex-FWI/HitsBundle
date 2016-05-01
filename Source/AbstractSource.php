<?php

namespace HitsBundle\Source;


use HitsBundle\HitsPage\HitsPageInterface;
use HitsBundle\Item;
use Symfony\Component\EventDispatcher\EventDispatcher;

abstract class AbstractSource implements SourceInterface
{
	private $name;
	/**
	 * @var HitsPageInterface[]
	 */
	private $hitsPages;

	/** @var  EventDispatcher */
	private $eventDispatcher;
	/**
	 * @param string $name
	 * @param HitsPageInterface[] $hitsPages
	 * @throws \Exception
	 */
	public function __construct($eventDispatcher, $name, array $hitsPages = array())
	{
		foreach($hitsPages as $page) {
			if(!in_array('HitsBundle\HitsPage\HitsPageInterface', class_implements($page))){
				throw new \Exception('You must provide an array of HitsPageInterface');
			}
			$this->hitsPages[] = $page;
		}

		$this->name = $name;
		$this->eventDispatcher = $eventDispatcher;
	}

	public function getName()
	{
		return $this->name;
	}

	/**
	 * @return \HitsBundle\HitsPage\HitsPageInterface[]
	 */
	public function getHitsPages()
	{
		return $this->hitsPages;
	}

	/**
	 * @param \HitsBundle\HitsPage\HitsPageInterface $hitsPage
	 * @return AbstractRadio
	 */
	public function addHitsPage(HitsPageInterface $hitsPage)
	{
		if (!in_array($hitsPage, $this->hitsPages)) {
			$this->hitsPages[] = $hitsPage;
		}
		return $this;
	}

	public function extractHits()
	{
		$items = [];
		foreach ($this->hitsPages as $hitPage) {
			$items = array_merge(
					$items,
					$hitPage->getExtractor()->extract($hitPage->getUrl())
			);
		}

		$items = array_map(function (Item $item) {
			$item->setSourceName($this->getName());
			return $item;

		}, $items);

		return $items;
	}

}