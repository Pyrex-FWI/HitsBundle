<?php

namespace HitsBundle\Event;

use HitsBundle\Extractor\ParserInterface;
use HitsBundle\Item;
use Symfony\Component\EventDispatcher\Event;

class SourceEvent extends Event
{
    /** @var Item[]  */
    protected $items;
    /** @var  ParserInterface */
    protected $parser;

    public function __construct(ParserInterface $parser, array $items)
    {
        $this->items = $items;
        $this->parser = $parser;
    }

    /**
     * @return Item[]
     */
    public function getItems()
    {
        return $this->items;
    }

}
