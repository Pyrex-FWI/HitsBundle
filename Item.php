<?php

namespace RadioHitsBundle;


class Item
{
	private $artist;
	private $title;

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

}