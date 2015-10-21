<?php

namespace RadioHitsBundle\Radio;


use RadioHitsBundle\Item;

interface RadioInterface
{
	public function getName();

	/**
	 * @return Item[]
	 */
	public function extractHits();
}