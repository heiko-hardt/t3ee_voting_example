<?php
namespace HeikoHardt\T3eeVotingExample\Controller;

    /***************************************************************
     *
     *  Copyright notice
     *
     *  (c) 2015 Heiko Hardt <heiko.hardt@pixelpark.com>, Pixelpark AG
     *
     *  All rights reserved
     *
     *  This script is part of the TYPO3 project. The TYPO3 project is
     *  free software; you can redistribute it and/or modify
     *  it under the terms of the GNU General Public License as published by
     *  the Free Software Foundation; either version 3 of the License, or
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

/**
 * TopicController
 */
class TopicController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * topicRepository
     *
     * @var \HeikoHardt\T3eeVotingExample\Domain\Repository\TopicRepository
     * @inject
     */
    protected $topicRepository = null;

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $topics = $this->topicRepository->findAll();
        $this->view->assign('topics', $topics);
    }

    /**
     * action show
     *
     * @param \HeikoHardt\T3eeVotingExample\Domain\Model\Topic $topic
     * @return void
     */
    public function showAction(\HeikoHardt\T3eeVotingExample\Domain\Model\Topic $topic)
    {
        $this->view->assign('topic', $topic);
    }

    /**
     * action new
     *
     * @return void
     */
    public function newAction()
    {

    }

    /**
     * action create
     *
     * @param \HeikoHardt\T3eeVotingExample\Domain\Model\Topic $newTopic
     * @return void
     */
    public function createAction(\HeikoHardt\T3eeVotingExample\Domain\Model\Topic $newTopic)
    {
        $this->addFlashMessage(
            'The object was created.
             Please be aware that this action is publicly accessible unless you implement an access check.
             See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain',
            '',
            \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR
        );
        $this->topicRepository->add($newTopic);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \HeikoHardt\T3eeVotingExample\Domain\Model\Topic $topic
     * @ignorevalidation $topic
     * @return void
     */
    public function editAction(\HeikoHardt\T3eeVotingExample\Domain\Model\Topic $topic)
    {
        $this->view->assign('topic', $topic);
    }

    /**
     * action update
     *
     * @param \HeikoHardt\T3eeVotingExample\Domain\Model\Topic $topic
     * @return void
     */
    public function updateAction(\HeikoHardt\T3eeVotingExample\Domain\Model\Topic $topic)
    {
        $this->addFlashMessage(
            'The object was updated.
             Please be aware that this action is publicly accessible unless you implement an access check.
             See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain',
            '',
            \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR
        );
        $this->topicRepository->update($topic);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \HeikoHardt\T3eeVotingExample\Domain\Model\Topic $topic
     * @return void
     */
    public function deleteAction(\HeikoHardt\T3eeVotingExample\Domain\Model\Topic $topic)
    {
        $this->addFlashMessage(
            'The object was deleted.
             Please be aware that this action is publicly accessible unless you implement an access check.
             See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain',
            '',
            \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR
        );
        $this->topicRepository->remove($topic);
        $this->redirect('list');
    }
}
