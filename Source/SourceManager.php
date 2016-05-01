<?php

namespace HitsBundle\Source;


use Doctrine\Common\Collections\ArrayCollection;

class SourceManager
{

	/** @var ArrayCollection<RadioInterface> */
	private $radios ;

	public function __construct($eventDispatcher)
	{
		$this->radios = new ArrayCollection();
	}

	/**
	 * Add Radio
	 * @param SourceInterface $radio
	 */
	public function addSource(SourceInterface $radio)
	{
		if (!$this->radios->contains($radio)) {
			$this->radios->add($radio);
		}
	}

	/**
	 * Get Radio from name
	 * @param $sourceName
	 * @return SourceInterface
	 */
	public function getSource($sourceName)
	{
		foreach ($this->radios->getValues() as $radio) {
			/** @var SourceInterface $radio */
			if ($radio->getName() === $sourceName) {
				return $radio;
			}
		}
	}

	/**
	 *
	 * @return Source[]
	 */
	public function getSourceList()
	{
		return $this->radios->toArray();
	}
}