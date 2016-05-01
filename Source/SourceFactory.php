<?php

namespace HitsBundle\Source;


use HitsBundle\Extractor\NrjAntillesHitsExtractor;
use HitsBundle\HitsPage\HitsPage;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

class SourceFactory
{

    /** @var  EventDispatcher */
    private $eventDispatcher;
    /** @var  LoggerInterface */
    private $logger;

    public function __construct($eventDispatcher, $logger)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->logger = $logger;
    }

    /**
     * @param $name
     * @param         return new Source($this->eventDispatcher, $name, (array)$hitsPages);

     * @param HitsPage[] $hitsPages
     * @return Source
     */
    public function createSource($name, $parserClass, $hitsPages) {

        $hitsPages = array_map( function ($url) use($parserClass) {
            $parser =  new $parserClass($this->eventDispatcher, $this->logger);
            return new HitsPage($url, $parser);

        }, $hitsPages);
        return new Source($this->eventDispatcher, $name, (array)$hitsPages);
    }
    /**
     * @param $name
     * @param HitsPage[] $hitsPages
     * @return Source
     */
    public function createSourceWithMultipleParser($name, $hitsPages) {
    }
}