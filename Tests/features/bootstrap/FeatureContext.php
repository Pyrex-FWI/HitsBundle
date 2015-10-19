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
     * @Given /^Get Radio manager$/
     */
    public function getRadioManager()
    {
        $this->radioManager = $this->getContainer()->get('radio_manager');
    }

    /** @Given /^Radio "([^"]*)" must be available$/ */
    public function iHaveAFileNamed($file)
    {
        touch($file);
    }
}
