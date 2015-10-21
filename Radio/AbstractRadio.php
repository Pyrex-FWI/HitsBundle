<?php

namespace RadioHitsBundle\Radio;


use RadioHitsBundle\HitsPage\HitsPageInterface;

abstract class AbstractRadio implements RadioInterface
{
	private $name;
	/**
	 * @var HitsPageInterface[]
	 */
	private $hitsPages;

	/**
	 * @param string $name
	 * @param HitsPageInterface[] $hitsPages
	 * @throws \Exception
	 */
	public function __construct($name, array $hitsPages = array())
	{
		foreach($hitsPages as $page) {
			if(!in_array('RadioHitsBundle\HitsPage\HitsPageInterface', class_implements($page))){
				throw new \Exception('You must provide an array of HitsPageInterface');
			}
			$this->hitsPages[] = $page;
		}

		$this->name = $name;
	}

	public function getName()
	{
		return $this->name;
	}

	/**
	 * @return \RadioHitsBundle\HitsPage\HitsPageInterface[]
	 */
	public function getHitsPages()
	{
		return $this->hitsPages;
	}

	/**
	 * @param \RadioHitsBundle\HitsPage\HitsPageInterface $hitsPage
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
					$hitPage->getExtractor()->extract()
			);
		}
		return $items;
	}

}