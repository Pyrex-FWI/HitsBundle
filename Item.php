<?php

namespace HitsBundle;


class Item
{
	private $artist;
	private $title;
	private $properlyDecoded = true;
	private $longTitle;
	private $uid;
	private $sourceName;
	/**
	 * @return mixed
	 */
	public function getArtist()
	{
		return $this->artist;
	}

	/**
	 * @param mixed $artist
	 * @return Item
	 */
	public function setArtist($artist)
	{
		$this->artist = $artist;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * @param mixed $title
	 * @return Item
	 */
	public function setTitle($title)
	{
		$this->title = $title;
		return $this;
	}

	/**
	 * @return boolean
	 */
	public function isProperlyDecoded()
	{
		return $this->properlyDecoded;
	}

	/**
	 * @param boolean $properlyDecoded
	 * @return Item
	 */
	public function setProperlyDecoded($properlyDecoded)
	{
		$this->properlyDecoded = $properlyDecoded;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getLongTitle()
	{
		return $this->longTitle;
	}

	/**
	 * @param mixed $longTitle
	 * @return Item
	 */
	public function setLongTitle($longTitle)
	{
		$this->longTitle = $longTitle;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getUid()
	{
		return $this->uid;
	}

	/**
	 * @param mixed $uid
	 * @return Item
	 */
	public function setUid($uid)
	{
		$this->uid = $uid;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getSourceName()
	{
		return $this->sourceName;
	}

	/**
	 * @param mixed $sourceName
	 * @return Item
	 */
	public function setSourceName($sourceName)
	{
		$this->sourceName = $sourceName;

		return $this;
	}


}