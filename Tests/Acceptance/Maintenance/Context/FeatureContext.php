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
     * @Then I should see the headline :headline
     */
    public function iShouldSeeTheHeadline($headline)
    {
        $extensionNode = $this->getSession()
            ->getPage()
            ->find('css', '.tx-t3ee-voting-example');

        $headlineNodes = $extensionNode->findAll('css', 'h1');

        if (count($headlineNodes) > 0) {
            foreach ($headlineNodes as $node) {
                if (preg_match('/' . $headline . '/i', $node->getText())) {
                    return true;
                }
            }
        }

        throw new \Exception('The headline "' . $headline . '" couldn\'t be found');
    }

    /**
     * @Then I should see :count topics
     */
    public function iShouldSeeTopics($count)
    {
        $extensionNode = $this->getSession()
            ->getPage()
            ->find('css', '.tx-t3ee-voting-example');

        $trNodes = $extensionNode->findAll('css', 'table.tx_t3eevotingexample tr');

        if (count($trNodes) - 1 <> $count) {
            throw new \Exception('There are ' . count($trNodes) - 1 . ' vote(s) found!');
        }
    }

    /**
     * @Then I should see :count attendees
     */
    public function iShouldSeeAttendees($count)
    {
        $extensionNode = $this->getSession()
            ->getPage()
            ->find('css', '.tx-t3ee-voting-example');

        $trNodes = $extensionNode->findAll('css', 'table.attendees tr');

        if (count($trNodes) <> $count) {
            throw new \Exception('There are ' . count($trNodes) . ' attendee(s) found!');
        }
    }

    /**
     * @Then I should see the topic :topicLabel and :voteCount votes
     */
    public function iShouldSeeTheTopicAndVotes($topicLabel, $voteCount)
    {
        $extensionNode = $this->getSession()
            ->getPage()
            ->find('css', '.tx-t3ee-voting-example');

        $rowNode = $extensionNode->find('css', sprintf('table tr:contains("%s")', $topicLabel));

        $tdNode = $rowNode->findAll('css', 'td');

        if (!preg_match('/' . $topicLabel . '/i', $tdNode[0]->getText())) {
            throw new \Exception('The label "' . $topicLabel . '" couldn\'t be found');
        }

        if (!preg_match('/' . $voteCount . '/i', $tdNode[3]->getText())) {
            throw new \Exception('The amount of ' . $voteCount . ' votes couldn\'t be found');
        }
    }

    /**
     * @When I press the :linkLabel link at the topic :topicLabel
     */
    public function iPressTheLinkAtTheTopic($linkLabel, $topicLabel)
    {
        $extensionNode = $this->getSession()
            ->getPage()
            ->find('css', '.tx-t3ee-voting-example');

        if (is_null($extensionNode)) {
            throw new \Exception('The extension container couldn\'t be found');
        }

        $trNode = $extensionNode->find('css', sprintf('table tr:contains("%s")', $topicLabel));
        if (is_null($trNode)) {
            throw new \Exception('The table row containing "' . $topicLabel . '" couldn\'t be found');
        }

        $linkNode = $linkLabel == 'Detail'
            ? $trNode->findLink($topicLabel)
            : $trNode->findLink($linkLabel);

        if (is_null($linkNode)) {
            throw new \Exception('The link "' . $linkLabel . '" couldn\'t be found');
        }

        $linkNode->click();
    }
}
