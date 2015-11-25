<?php
namespace HeikoHardt\T3eeVotingExample\Tests\Unit\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Heiko Hardt <heiko.hardt@pixelpark.com>, Pixelpark AG
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use \TYPO3\CMS\Core\Tests\UnitTestCase;

use \HeikoHardt\T3eeVotingExample\Domain\Model\Topic;

/**
 * Test case for class HeikoHardt\T3eeVotingExample\Controller\TopicController.
 *
 * @author Heiko Hardt <heiko.hardt@pixelpark.com>
 */
class TopicControllerTest extends UnitTestCase
{

    /**
     * @var \HeikoHardt\T3eeVotingExample\Controller\TopicController
     */
    protected $subject = null;

    public function setUp()
    {
        $this->subject = $this->getMock(
            'HeikoHardt\\T3eeVotingExample\\Controller\\TopicController',
            array('redirect', 'forward', 'addFlashMessage'),
            array(),
            '',
            false
        );
    }

    public function tearDown()
    {
        unset($this->subject);
    }

    /**
     * @test
     */
    public function listActionFetchesAllTopicsFromRepositoryAndAssignsThemToView()
    {
        $allTopics = $this->getMock(
            'TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage',
            array(),
            array(),
            '',
            false
        );

        $topicRepository = $this->getMock(
            'HeikoHardt\\T3eeVotingExample\\Domain\\Repository\\TopicRepository',
            array('findAll'),
            array(),
            '',
            false
        );

        $topicRepository->expects($this->once())->method('findAll')->will($this->returnValue($allTopics));
        $this->inject($this->subject, 'topicRepository', $topicRepository);

        $view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
        $view->expects($this->once())->method('assign')->with('topics', $allTopics);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenTopicToView()
    {
        $topic = new Topic();

        $view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
        $this->inject($this->subject, 'view', $view);
        $view->expects($this->once())->method('assign')->with('topic', $topic);

        $this->subject->showAction($topic);
    }

    /**
     * @test
     */
    public function newActionReturnNull()
    {
        $this->assertSame(
            null,
            $this->subject->newAction()
        );
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenTopicToTopicRepository()
    {
        $topic = new Topic();

        $topicRepository = $this->getMock(
            'HeikoHardt\\T3eeVotingExample\\Domain\\Repository\\TopicRepository',
            array('add'),
            array(),
            '',
            false
        );

        $topicRepository->expects($this->once())->method('add')->with($topic);
        $this->inject($this->subject, 'topicRepository', $topicRepository);

        $this->subject->createAction($topic);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenTopicToView()
    {
        $topic = new Topic();

        $view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
        $this->inject($this->subject, 'view', $view);
        $view->expects($this->once())->method('assign')->with('topic', $topic);

        $this->subject->editAction($topic);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenTopicInTopicRepository()
    {
        $topic = new Topic();

        $topicRepository = $this->getMock(
            'HeikoHardt\\T3eeVotingExample\\Domain\\Repository\\TopicRepository',
            array('update'),
            array(),
            '',
            false
        );

        $topicRepository->expects($this->once())->method('update')->with($topic);
        $this->inject($this->subject, 'topicRepository', $topicRepository);

        $this->subject->updateAction($topic);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenTopicFromTopicRepository()
    {
        $topic = new Topic();

        $topicRepository = $this->getMock(
            'HeikoHardt\\T3eeVotingExample\\Domain\\Repository\\TopicRepository',
            array('remove'),
            array(),
            '',
            false
        );

        $topicRepository->expects($this->once())->method('remove')->with($topic);
        $this->inject($this->subject, 'topicRepository', $topicRepository);

        $this->subject->deleteAction($topic);
    }
}
