<?php
namespace HeikoHardt\T3eeVotingExample\Tests\Unit\Domain\Model;

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
use \TYPO3\CMS\Extbase\Persistence\ObjectStorage;

use \HeikoHardt\T3eeVotingExample\Domain\Model\Topic;
use \HeikoHardt\T3eeVotingExample\Domain\Model\Attendee;

/**
 * Test case for class \HeikoHardt\T3eeVotingExample\Domain\Model\Topic.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Heiko Hardt <heiko.hardt@pixelpark.com>
 */
class TopicTest extends UnitTestCase
{
    /**
     * @var \HeikoHardt\T3eeVotingExample\Domain\Model\Topic
     */
    protected $subject = null;

    public function setUp()
    {
        $this->subject = new Topic();
    }

    public function tearDown()
    {
        unset($this->subject);
    }

    /**
     * @test
     */
    public function getIssueReturnsInitialValueForString()
    {
        $this->assertSame(
            '',
            $this->subject->getIssue()
        );
    }

    /**
     * @test
     */
    public function setIssueForStringSetsIssue()
    {
        $this->subject->setIssue('Conceived at T3CON10');

        $this->assertAttributeEquals(
            'Conceived at T3CON10',
            'issue',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getYesReturnsInitialValueForInt()
    {
        $this->assertSame(
            0,
            $this->subject->getYes()
        );
    }

    /**
     * @test
     */
    public function setYesForIntSetsYes()
    {
        $this->subject->setYes(7293);

        $this->assertAttributeEquals(
            7293,
            'yes',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getNoReturnsInitialValueForInt()
    {
        $this->assertSame(
            0,
            $this->subject->getNo()
        );
    }

    /**
     * @test
     */
    public function setNoForIntSetsNo()
    {
        $this->subject->setNo(7293);

        $this->assertAttributeEquals(
            7293,
            'no',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getAttendeesReturnsInitialValueForAttendee()
    {
        $newObjectStorage = new ObjectStorage();

        $this->assertEquals(
            $newObjectStorage,
            $this->subject->getAttendees()
        );
    }

    /**
     * @test
     */
    public function setAttendeesForObjectStorageContainingAttendeeSetsAttendees()
    {
        $attendee = new Attendee();

        $objectStorage = new ObjectStorage();
        $objectStorage->attach($attendee);

        $this->subject->setAttendees($objectStorage);

        $this->assertAttributeEquals(
            $objectStorage,
            'attendees',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addAttendeeToObjectStorageHoldingAttendees()
    {
        $attendee = new Attendee();

        $attendees = $this->getMock(
            'TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage',
            array('attach'),
            array(),
            '',
            false
        );

        $attendees->expects($this->once())->method('attach')->with($this->equalTo($attendee));

        $this->inject($this->subject, 'attendees', $attendees);

        $this->subject->addAttendee($attendee);
    }

    /**
     * @test
     */
    public function removeAttendeeFromObjectStorageHoldingAttendees()
    {
        $attendee = new Attendee();

        $attendees = $this->getMock(
            'TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage',
            array('detach'),
            array(),
            '',
            false
        );

        $attendees->expects($this->once())->method('detach')->with($this->equalTo($attendee));

        $this->inject($this->subject, 'attendees', $attendees);

        $this->subject->removeAttendee($attendee);
    }
}
