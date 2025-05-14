<?php
namespace Maintenance\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use HeikoHardt\Behat\TYPO3Extension\Context\Typo3Context as BaseTypo3Context;

use \HeikoHardt\T3eeVotingExample\Domain\Model\Topic;
use \HeikoHardt\T3eeVotingExample\Domain\Model\Attendee;

class TYPO3Context extends BaseTypo3Context implements Context {

    protected $typo3ObjectManager;
    protected $topicRepository;
    protected $typo3PersistenceManager;

    /** @BeforeScenario */
    public function before(BeforeScenarioScope $scope)
    {
        $this->typo3ObjectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
        $this->typo3PersistenceManager = $this->typo3ObjectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
        $this->topicRepository = $this->typo3ObjectManager->get('HeikoHardt\\T3eeVotingExample\\Domain\\Repository\\TopicRepository');
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
