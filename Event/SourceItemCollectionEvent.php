<?php

namespace HitsBundle\Event;

use HitsBundle\Extractor\ParserInterface;
use HitsBundle\Item;
use Symfony\Component\EventDispatcher\Event;

class SourceItemCollectionEvent extends AbstractEvent
{
    /** @var Item[]  */
    protected $items;

    public function __construct(ParserInterface $parser, array $items)
    {
        $this->items = $items;
        parent::__construct($parser);
    }

    /**
     * @return Item[]
     */
    public function getItems()
    {
        return $this->items;
    }
}
