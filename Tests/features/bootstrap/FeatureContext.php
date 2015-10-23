<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    use \Behat\Symfony2Extension\Context\KernelDictionary;

    /** @var  \RadioHitsBundle\Radio\RadioManager */
    private $radioManager;

    /** @var  \RadioHitsBundle\Radio\RadioInterface */
    private $lastUsedRadio;
    /** @var  \RadioHitsBundle\Item[] */
    private $lastExtractedItems;
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {

    }

    /**
     * @Given /^Retrieve Radio manager$/
     */
    public function getRadioManager()
    {
        $this->radioManager = $this->getContainer()->get('radio_manager');
        if (get_class($this->radioManager) !== 'RadioHitsBundle\Radio\RadioManager') {
            throw new \Exception('This manager class is wrong');
        }
    }

    /** @Then /^Radio "([^"]*)" must be available$/ */
    public function getRadio($name)
    {
        if (! $this->radioManager->getRadio($name)) {
            throw new \Exception(sprintf('%s not found',$name));
        }
        $this->lastUsedRadio = $this->radioManager->getRadio($name);
    }
    /** @Then /^Fetch hits$/ */
    public function getHitsItems()
    {
        $this->lastExtractedItems = null;
        $this->lastExtractedItems = $this->lastUsedRadio->extractHits();
    }

    /**
     * @When I read all hit pages from :radio, i must found :nbItem
     */
    public function iReadAllHitPagesFromIMustFound($radio, $nbItem)
    {
        $this->getRadio($radio);
        $this->getHitsItems();
        $count = count($this->lastExtractedItems);
        if ( $count != $nbItem) {
            throw new \Exception(sprintf('%s item found instead %s expected', $count, $nbItem));
        }
    }

    /**
     * @When i print hits result
     */
    public function iPrintHitsResult()
    {
        var_dump($this->lastExtractedItems);
    }


}
