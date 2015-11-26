<?php
namespace Maintenance\Context;

use Behat\Behat\Context\Context;
use Behat\Testwork\Tester\Exception\TesterException;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Testwork\Exception\Cli;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;

use \HeikoHardt\T3eeVotingExample\Domain\Model\Topic;
use \HeikoHardt\T3eeVotingExample\Domain\Model\Attendee;

class TYPO3Context extends \HeikoHardt\Behat\TYPO3Extension\Context\Typo3Context implements Context
{

    /** @var \HeikoHardt\T3eeVotingExample\Domain\Repository\TopicRepository */
    protected $topicRepository = null;

    /** @BeforeScenario */
    public function before(BeforeScenarioScope $scope)
    {

        try {
            // setup core extensions
            $this->setTYPO3CoreExtensionsToLoad(array('extbase', 'fluid'));

            // setup test extensions
            $this->setTYPO3TestExtensionsToLoad(array('typo3conf/ext/t3ee_voting_example'));

            // extend default local configuration
            $this->setTYPO3LocalConfiguration(array('SYS' => array('encryptionKey' => 'mysecretencryptionkey')));

            // import initial db values
            $this->setTYPO3DatasetToImport(array(
                getenv('TYPO3_PATH_WEB') . '/typo3/sysext/core/Tests/Functional/Fixtures/pages.xml'
            ));

            // setup basic frontend page
            $this->setTYPO3FrontendRootPage(
                1,
                array('typo3conf/ext/t3ee_voting_example/Tests/Acceptance/Maintenance/Fixtures/TypoScript/Setup.ts')
            );

            // boot typo3
            $this->TYPO3Boot($this, $scope);

            // prepare topic repository
            $this->topicRepository = $this->typo3ObjectManager->get(
                'HeikoHardt\\T3eeVotingExample\\Domain\\Repository\\TopicRepository'
            );

        } catch (\Exception $e) {
        }

    }

    /**
     * @Given there are :count topics
     */
    public function thereAreTopics($count)
    {
        for ($i = 0; $i < $count; $i++) {
            $attendee = new Attendee();
            $attendee->setName('Example Name ' . ($i + 1));
            $attendee->setEmail('example@domain.com');
            $attendee->setPid(1);

            $topic = new Topic();
            $topic->setIssue('Do you think it may ' . ($i + 1) . '...');
            $topic->setPid(1);
            $topic->addAttendee($attendee);

            $this->topicRepository->add($topic);

        }
        $this->typo3PersistenceManager->persistAll();
    }

    /**
     * @Given there is a topic labeled :topicLabel having :attendeeCount votes
     */
    public function thereIsATopicLabeledHavingVotes($topicLabel, $attendeeCount)
    {
        $topic = new Topic();
        $topic->setIssue($topicLabel);
        $topic->setPid(1);

        for ($i = 0; $i < $attendeeCount; $i++) {
            $attendee = new Attendee();
            $attendee->setName('Example Name ' . ($i + 1));
            $attendee->setEmail('example' . ($i + 1) . '@domain.com');
            $attendee->setPid(1);
            $topic->addAttendee($attendee);
        }

        // add topic
        $this->topicRepository->add($topic);

        // persist topic
        $this->typo3PersistenceManager->persistAll();
    }
}
