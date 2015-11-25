<?php
namespace Maintenance\Context;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;

// contexts
use HeikoHardt\Behat\TYPO3Extension\Context\Typo3Context;
use Behat\MinkExtension\Context\MinkContext;

$x = 1;

class FeatureContext extends MinkContext implements Context, SnippetAcceptingContext
{

    public function __construct()
    {
        $x = 1;
    }

    /**
     * @When I wait
     */
    public function iWait()
    {

        // max time to wait
        $time = 2000; // time should be in milliseconds

        // $this->getSession()->wait($time, '(0 === Ajax.activeRequestCount)');
        // $this->getSession()->wait($time, '(0 === jQuery.active)');
        $this->getSession()->wait($time);

    }

    /**
     * @Given wait for the initial voting module
     */
    public function waitForTheInitialVotingModule()
    {

        $time = 5000; // time should be in milliseconds
        $this->getSession()->wait($time, '(0 === jQuery.active)');

    }
}
