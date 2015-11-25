<?php
namespace Maintenance\Context;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

use Behat\MinkExtension\Context\MinkContext;

class FeatureContext extends MinkContext implements Context, SnippetAcceptingContext
{

    public function __construct()
    {

    }

    /**
     * @Then I should see :count votes
     */
    public function iShouldSeeVotes($count)
    {

        $table = $this->getSession()->getPage()->find('css', 'table.tx_t3eevotingexample');

        if (is_null($table)) {
            throw new \Exception('Table couldn\'t be found!');
        }

        $trs = $table->findAll('css', 'table.tx_t3eevotingexample tr');

        if (count($trs) - 1 <> $count) {
            throw new \Exception('There are ' . count($trs) - 1 . ' vote(s) found!');
        }

    }

    /**
     * @Then I should see the headline :headline
     */
    public function iShouldSeeTheHeadline($headline)
    {
        $page = $this->getSession()->getPage()->findAll('css', 'h1');
        if (count($page) > 0) {
            foreach ($page as $node) {
                if (preg_match('/' . $headline . '/i', $node->getText())) {
                    return true;
                }
            }
        }

        throw new \Exception('The Headline "' . $headline . '" couldn\'t be found');
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
