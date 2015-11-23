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

/**
 * Test case for class \HeikoHardt\T3eeVotingExample\Domain\Model\Topic.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Heiko Hardt <heiko.hardt@pixelpark.com>
 */
class TopicTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \HeikoHardt\T3eeVotingExample\Domain\Model\Topic
	 */
	protected $subject = NULL;

	public function setUp() {
		$this->subject = new \HeikoHardt\T3eeVotingExample\Domain\Model\Topic();
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getIssueReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getIssue()
		);
	}

	/**
	 * @test
	 */
	public function setIssueForStringSetsIssue() {
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
	public function getYesReturnsInitialValueForInt() {	}

	/**
	 * @test
	 */
	public function setYesForIntSetsYes() {	}

	/**
	 * @test
	 */
	public function getNoReturnsInitialValueForInt() {	}

	/**
	 * @test
	 */
	public function setNoForIntSetsNo() {	}

	/**
	 * @test
	 */
	public function getAttendeesReturnsInitialValueForAttendee() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getAttendees()
		);
	}

	/**
	 * @test
	 */
	public function setAttendeesForObjectStorageContainingAttendeeSetsAttendees() {
		$attendee = new \HeikoHardt\T3eeVotingExample\Domain\Model\Attendee();
		$objectStorageHoldingExactlyOneAttendees = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneAttendees->attach($attendee);
		$this->subject->setAttendees($objectStorageHoldingExactlyOneAttendees);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneAttendees,
			'attendees',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addAttendeeToObjectStorageHoldingAttendees() {
		$attendee = new \HeikoHardt\T3eeVotingExample\Domain\Model\Attendee();
		$attendeesObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$attendeesObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($attendee));
		$this->inject($this->subject, 'attendees', $attendeesObjectStorageMock);

		$this->subject->addAttendee($attendee);
	}

	/**
	 * @test
	 */
	public function removeAttendeeFromObjectStorageHoldingAttendees() {
		$attendee = new \HeikoHardt\T3eeVotingExample\Domain\Model\Attendee();
		$attendeesObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$attendeesObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($attendee));
		$this->inject($this->subject, 'attendees', $attendeesObjectStorageMock);

		$this->subject->removeAttendee($attendee);

	}
}
