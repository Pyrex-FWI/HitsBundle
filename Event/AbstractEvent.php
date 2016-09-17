<?php

namespace HitsBundle\Event;

use HitsBundle\Extractor\ParserInterface;
use HitsBundle\Item;
use Symfony\Component\EventDispatcher\Event;

abstract class AbstractEvent extends Event
{
    /** @var  ParserInterface */
    protected $parser;

    public function __construct(ParserInterface $parser)
    {
        $this->parser = $parser;
    }

    final public function getParser()
    {
        return $this->parser;
    }
}
