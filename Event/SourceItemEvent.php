<?php

namespace HitsBundle\Event;

use HitsBundle\Extractor\ParserInterface;
use HitsBundle\Item;
use Symfony\Component\EventDispatcher\Event;

class SourceItemEvent extends AbstractEvent
{
    /** @var Item  */
    protected $item;

    public function __construct(ParserInterface $parser, Item $item)
    {
        $this->item = $item;
        parent::__construct($parser);
    }

    /**
     * @return Item
     */
    public function getItem()
    {
        return $this->item;
    }
}
