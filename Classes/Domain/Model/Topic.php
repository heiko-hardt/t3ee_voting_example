<?php
namespace HeikoHardt\T3eeVotingExample\Domain\Model;


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
 * Topic
 */
class Topic extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * issue
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $issue = '';

	/**
	 * yes
	 *
	 * @var int
	 */
	protected $yes = 0;

	/**
	 * no
	 *
	 * @var int
	 */
	protected $no = 0;

	/**
	 * attendees
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\HeikoHardt\T3eeVotingExample\Domain\Model\Attendee>
	 * @cascade remove
	 */
	protected $attendees = NULL;

	/**
	 * __construct
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties
	 * Do not modify this method!
	 * It will be rewritten on each save in the extension builder
	 * You may modify the constructor of this class instead
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		$this->attendees = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the issue
	 *
	 * @return string $issue
	 */
	public function getIssue() {
		return $this->issue;
	}

	/**
	 * Sets the issue
	 *
	 * @param string $issue
	 * @return void
	 */
	public function setIssue($issue) {
		$this->issue = $issue;
	}

	/**
	 * Returns the yes
	 *
	 * @return int $yes
	 */
	public function getYes() {
		return $this->yes;
	}

	/**
	 * Sets the yes
	 *
	 * @param int $yes
	 * @return void
	 */
	public function setYes($yes) {
		$this->yes = $yes;
	}

	/**
	 * Returns the no
	 *
	 * @return int $no
	 */
	public function getNo() {
		return $this->no;
	}

	/**
	 * Sets the no
	 *
	 * @param int $no
	 * @return void
	 */
	public function setNo($no) {
		$this->no = $no;
	}

	/**
	 * Adds a Attendee
	 *
	 * @param \HeikoHardt\T3eeVotingExample\Domain\Model\Attendee $attendee
	 * @return void
	 */
	public function addAttendee(\HeikoHardt\T3eeVotingExample\Domain\Model\Attendee $attendee) {
		$this->attendees->attach($attendee);
	}

	/**
	 * Removes a Attendee
	 *
	 * @param \HeikoHardt\T3eeVotingExample\Domain\Model\Attendee $attendeeToRemove The Attendee to be removed
	 * @return void
	 */
	public function removeAttendee(\HeikoHardt\T3eeVotingExample\Domain\Model\Attendee $attendeeToRemove) {
		$this->attendees->detach($attendeeToRemove);
	}

	/**
	 * Returns the attendees
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\HeikoHardt\T3eeVotingExample\Domain\Model\Attendee> $attendees
	 */
	public function getAttendees() {
		return $this->attendees;
	}

	/**
	 * Sets the attendees
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\HeikoHardt\T3eeVotingExample\Domain\Model\Attendee> $attendees
	 * @return void
	 */
	public function setAttendees(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $attendees) {
		$this->attendees = $attendees;
	}

}