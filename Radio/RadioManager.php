<?php

namespace RadioHitsBundle\Radio;


use Doctrine\Common\Collections\ArrayCollection;

class RadioManager
{

	/** @var ArrayCollection<RadioInterface> */
	private $radios ;

	public function __construct()
	{
		$this->radios = new ArrayCollection();
	}

	/**
	 * Add Radio
	 * @param RadioInterface $radio
	 */
	public function addRadio(RadioInterface $radio)
	{
		if (!$this->radios->contains($radio)) {
			$this->radios->add($radio);
		}
	}

	/**
	 * Get Radio from name
	 * @param $radioName
	 * @return RadioInterface
	 */
	public function getRadio($radioName)
	{
		foreach ($this->radios->getValues() as $radio) {
			/** @var RadioInterface $radio */
			if ($radio->getName() === $radioName) {
				return $radio;
			}
		}
	}

	public function getItems($radioName)
	{
		$radio = $this->getRadio($radioName);
		$radio->extractHits();
	}
}