<?php

use Behat\Behat\Context\Context;
use Behat\Testwork\Tester\Exception\TesterException;
use Behat\Testwork\Exception\Cli;

use Behat\Behat\Hook\Scope\BeforeScenarioScope;

class TYPO3VoteContext extends \HeikoHardt\Behat\TYPO3Extension\Context\Typo3Context implements Context
{

    /** @var \HeikoHardt\T3eeVotingExample\Domain\Repository\TopicRepository */
    protected $topicRepository = null;

    /** @BeforeScenario */
    public function before(BeforeScenarioScope $scope)
    {

        try {
            // setup core extension
            $this->setTYPO3CoreExtensionsToLoad(array('extbase', 'fluid'));

            // setup test extensions
            $this->setTYPO3TestExtensionsToLoad(array('typo3conf/ext/t3ee_voting_example'));

            // extend default local configuration
            $this->setTYPO3LocalConfiguration(array('SYS' => array('encryptionKey' => 'mysecretencryptionkey')));

            // import initial db values
            $this->setTYPO3DatasetToImport(array(
                getenv('TYPO3_PATH_WEB') . '/typo3/sysext/core/Tests/Functional/Fixtures/pages.xml',
                getenv('TYPO3_PATH_WEB') . '/typo3conf/ext/t3ee_voting_example/Tests/Acceptance/Fixtures/tx_t3eevotingexample_domain_model_topic.xml'
            ));

            // setup basic frontend page
            $this->setTYPO3FrontendRootPage(1, array(
                'typo3conf/ext/t3ee_voting_example/Tests/Acceptance/Fixtures/Setup_Pi2.ts'
            ));

            // boot typo3
            $this->TYPO3Boot($this, $scope);

            // prepare topic repository
            $this->topicRepository = $this->typo3ObjectManager->get(
                '\\HeikoHardt\\T3eeVotingExample\\Domain\\Repository\\TopicRepository'
            );

        } catch (\Exception $e) {
            $x = 1;

        }

    }

}
