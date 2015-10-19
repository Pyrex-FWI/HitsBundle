<?php

namespace RadioHitsBundle\Radio;


use RadioHitsBundle\HitsPage\HitsPageInterface;

abstract class AbstractRadio
{
	private $name;
	/**
	 * @var HitsPageInterface[]
	 */
	private $hitsPages;
	/**
	 * @param HitsPageInterface[] $hitsPages
	 */
	public function __construct(array $hitsPages)
	{
		foreach($hitsPages as $page) {
			if(!in_array('RadioHitsBundle\HitsPage\HitsPageInterface', get_declared_interfaces($page))){
				throw new \Exception('You must provide an array of HitsPageInterface');
			}
			$this->hitsPages[] = $page;
		}
	}
}