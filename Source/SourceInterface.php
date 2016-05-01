<?php

namespace HitsBundle\Source;


use HitsBundle\Item;

interface SourceInterface
{
	public function getName();

	/**
	 * @return Item[]
	 */
	public function extractHits();
}