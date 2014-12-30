<?php
namespace DieMedialen\DmSimplecalendar\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Kai Ratzeburg <hello@kai-ratzeburg.de>, Die Medialen
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
 * Appointment
 *
 * @package dm_simplecalendar
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Appointment extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

    /**
     * categories
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\DieMedialen\DmSimplecalendar\Domain\Model\Category>
     * @cascade remove
     */
    protected $categories = NULL;

    /**
     * media
     *
     * @var \DieMedialen\DmSimplecalendar\Domain\Model\Media
     */
    protected $media = NULL;

    /**
     * preAppointment
     *
     * @lazy
     * @var \DieMedialen\DmSimplecalendar\Domain\Model\Appointment
     */
    protected $preAppointment;

    /**
     * location
     *
     * @var \string
     */
    protected $location;

    /**
     * description
     *
     * @var \string
     */
    protected $description;

    /**
     * shortdescription
     *
     * @var \string
     */
    protected $shortdescription;

    /**
     * startdate
     *
     * @var \DateTime
     * @validate NotEmpty
     */
    protected $startdate;

    /**
     * enddate
     *
     * @var \DateTime
     */
    protected $enddate;

    /**
     * title
     *
     * @var \string
     * @validate NotEmpty
     */
    protected $title;

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
        $this->categories = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Adds a Category
     *
     * @param \DieMedialen\DmSimplecalendar\Domain\Model\Category $category
     * @return void
     */
    public function addCategory(\DieMedialen\DmSimplecalendar\Domain\Model\Category $category) {
        $this->categories->attach($category);
    }

    /**
     * Removes a Category
     *
     * @param \DieMedialen\DmSimplecalendar\Domain\Model\Category $categoryToRemove The Category to be removed
     * @return void
     */
    public function removeCategory(\DieMedialen\DmSimplecalendar\Domain\Model\Category $categoryToRemove) {
        $this->categories->detach($categoryToRemove);
    }

    /**
     * Returns the categories
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\DieMedialen\DmSimplecalendar\Domain\Model\Category> $categories
     */
    public function getCategories() {
        return $this->categories;
    }

    /**
     * Sets the categories
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\DieMedialen\DmSimplecalendar\Domain\Model\Category> $categories
     * @return void
     */
    public function setCategories(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $categories) {
        $this->categories = $categories;
    }

    /**
     * Returns the media
     *
     * @return \DieMedialen\DmSimplecalendar\Domain\Model\Media $media
     */
    public function getMedia() {
        return $this->media;
    }

    /**
     * Sets the media
     *
     * @param \DieMedialen\DmSimplecalendar\Domain\Model\Media $media
     * @return void
     */
    public function setMedia(\DieMedialen\DmSimplecalendar\Domain\Model\Media $media) {
        $this->media = $media;
    }

    /**
     * Returns the preAppointment
     *
     * @return \DieMedialen\DmSimplecalendar\Domain\Model\Appointment $preAppointment
     */
    public function getPreAppointment() {
        return $this->preAppointment;
    }

    /**
     * Sets the preAppointment
     *
     * @param \DieMedialen\DmSimplecalendar\Domain\Model\Appointment $preAppointment
     * @return void
     */
    public function setPreAppointment(\DieMedialen\DmSimplecalendar\Domain\Model\Appointment $preAppointment) {
        $this->preAppointment = $preAppointment;
    }

    /**
     * Returns the location
     *
     * @return \string $location
     */
    public function getLocation() {
        return $this->location;
    }

    /**
     * Sets the location
     *
     * @param \string $location
     * @return void
     */
    public function setLocation($location) {
        $this->location = $location;
    }

    /**
     * Returns the description
     *
     * @return \string $description
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Sets the description
     *
     * @param \string $description
     * @return void
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * Returns the shortdescription
     *
     * @return \string $shortdescription
     */
    public function getShortdescription() {
        return $this->shortdescription;
    }

    /**
     * Sets the shortdescription
     *
     * @param \string $shortdescription
     * @return void
     */
    public function setShortdescription($shortdescription) {
        $this->shortdescription = $shortdescription;
    }

    /**
     * Returns the startdate
     *
     * @return \DateTime $startdate
     */
    public function getStartdate() {
        return $this->startdate;
    }

    /**
     * Sets the startdate
     *
     * @param \DateTime $startdate
     * @return void
     */
    public function setStartdate($startdate) {
        $this->startdate = $startdate;
    }

    /**
     * Returns the enddate
     *
     * @return \DateTime $enddate
     */
    public function getEnddate() {
        return $this->enddate;
    }

    /**
     * Returns true if enddate is valid and different to startdate 
     *
     * @return \bool $bool
     */
    public function getEnddateExists() {
        $bool = TRUE;
        if($this->enddate) {
            if($this->startdate->getTimestamp() == $this->enddate->getTimestamp()) {
                $bool = FALSE;
            }
        } else {
            $bool = FALSE;
        }
        return $bool;
    }

    /**
     * Sets the enddate
     *
     * @param \DateTime $enddate
     * @return void
     */
    public function setEnddate($enddate) {
        $this->enddate = $enddate;
    }

    /**
     * Returns the title
     *
     * @return \string $title
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param \string $title
     * @return void
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * Checks if appointment is in range.
     *
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     * @return \bool
     */
    public function isInRange(\DateTime $startDate, \DateTime $endDate) {
        $startTsp = $this->getStartdate()->getTimestamp();
        if($this->getEnddate() === NULL) {
            $endTsp = $startTsp;
        } else {
            $endTsp = $this->getEnddate()->getTimestamp();
        }
        $startDay = $startDate->getTimestamp();
        $endDay = $endDate->getTimestamp();

        $appointmentStartsAtDay = $startTsp >= $startDay && $startTsp <= $endDay;
        $appointmentEndsAtDay = $endTsp >= $startDay && $endTsp <= $endDay;
        $dayStartsInAppointment = $startDay >= $startTsp && $startDay <= $endTsp;
        $dayEndsInAppointment = $endDay >= $startTsp && $endDay <= $endTsp;
    
        return ($dayStartsInAppointment && $dayEndsInAppointment) || $appointmentEndsAtDay || $appointmentStartsAtDay;
    }
}
?>