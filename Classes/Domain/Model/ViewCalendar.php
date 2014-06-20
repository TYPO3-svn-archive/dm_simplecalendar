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

define('STR_YEAR', 'year');
define('STR_MONTH', 'month');
define('STR_WEEK', 'week');
define('STR_DAY', 'day');

/**
 * ViewCalendar
 *
 * @package dm_simplecalendar
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class ViewCalendar extends \TYPO3\CMS\Extbase\DomainObject\AbstractValueObject {

    /**
     * objectManager
     *
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager     
     * @inject
     */
    protected $objectManager;

    /**
     * timestamp
     * 
     * @var \int
     */
    protected $timestamp;

    /**
     * viewMode
     *
     * @var \string
     */
    protected $mode = 'month';

    /**
     * appointments
     *
     * @var \array
     */
    protected $appointments;

    /**
     * Gets the timestamp.
     *
     * @return \int
     */
    public function getTimestamp() {
        return $this->timestamp;
    }
    
    /**
     * Sets the timestamp.
     *
     * @param \int $timestamp the timestamp
     */
    public function setTimestamp($timestamp) {
        if(!$this->isTimestamp($timestamp)) {
            throw new \Exception('Timestamp (' . $timestamp . ') is not valid.');
        }

        $this->timestamp = $timestamp;
    }

    /**
     * Gets the viewMode.
     *
     * @return \string
     */
    public function getMode() {
        return $this->mode;
    }
    
    /**
     * Sets the viewMode.
     *
     * @param \string $mode the mode
     */
    public function setMode($mode) {
        $this->mode = $mode;
    }

    /**
     * Gets the appointments.
     *
     * @return \array
     */
    public function getAppointments() {
        return $this->appointments;
    }

    /**
     * Gets the appointments by day.
     *
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     * @return \array
     */
    public function getAppointmentsFromRange(\DateTime $startDate, \DateTime $endDate) {
        $appointmentsArray = array();

        foreach($this->appointments as $key => $appointment) {
            if($appointment->isInRange($startDate, $endDate)) {
                $appointmentsArray[] = $appointment;
            }
        }

        return $appointmentsArray;
    }
    
    /**
     * Sets the appointments.
     *
     * @param \array $appointments
     */
    public function setAppointments($appointments) {
        $this->appointments = $appointments;
    }

    /**
     * Gets the start date from current timestamp.
     *
     * @return \DateTime
     */
    public function getStartDate() {
        $startDate = new \DateTime('@' . $this->getTimestamp());

        switch($this->getMode()) {
            case STR_YEAR:
                $startDate->modify('first day of January');
                break;
            case STR_MONTH:
                $startDate->modify('first day of this month');
                break;
            case STR_WEEK:
                $date = date('w', $startDate->getTimestamp());
                if($date != 1) {
                    $startDate->modify('last Monday');
                }
                break;
            case STR_DAY:
                break;
            default:
                throw new \Exception("ViewMode is not known in ViewCalendar.");
                break;
        }

        $startDate->setTime(0, 0, 0);
        return $startDate;
    }

    /**
     * Gets the end date from current timestamp.
     *
     * @return \DateTime
     */
    public function getEndDate() {
        $endDate = new \DateTime('@' . $this->getTimestamp());

        switch($this->getMode()) {
            case STR_YEAR:
                $endDate->modify('last day of December');
                break;
            case STR_MONTH:
                $endDate->modify('last day of this month');
                break;
            case STR_WEEK:
                $date = date('w', $endDate->getTimestamp());
                if($date != 0) {
                    $endDate->modify('next Sunday');
                }
                break;
            case STR_DAY:
                break;
            default:
                throw new \Exception("ViewMode is not known in ViewCalendar.");
                break;
        }

        $endDate->setTime(23, 59, 59);
        return $endDate;
    }

    /**
     * Get the current timestamp
     * 
     * @return \int
     */
    public function getCurrent() {
        $currentDate = new \DateTime();
        return $currentDate->getTimestamp();
    }

    /**
     * Get the previous timestamp by mode
     * 
     * @return \int
     */
    public function getPrevious() {
        $previousDate = $this->getStartDate();
        $previousDate->modify('-1 ' . $this->getMode());

        return $previousDate->getTimestamp();
    }

    /**
     * Get the next timestamp by mode
     * 
     * @return \int
     */
    public function getNext() {
        $nextDate = $this->getStartDate();
        $nextDate->modify('+1 ' . $this->getMode());

        return $nextDate->getTimestamp();
    }

    /**
     * Get the sub calenders by view calendar.
     *
     * @param \string $subCalendarMode
     * @validate $subCalendarMode NotEmpty
     * @return \array
     */
    public function getSubCalendars($subCalendarMode) {
        $subViewCalendars = array();
        $startDate = $this->getStartDate();
        $endDate = $this->getEndDate();

        while($startDate < $endDate) {
            $subViewCalendar = $this->objectManager->get('DieMedialen\DmSimplecalendar\Domain\Model\ViewCalendar');
            $subViewCalendar->setTimestamp($startDate->getTimestamp());
            $subViewCalendar->setMode($subCalendarMode);
            $subViewCalendar->setAppointments($this->getAppointmentsFromRange($subViewCalendar->getStartDate(), $subViewCalendar->getEndDate()));

            $startDate = $subViewCalendar->getEndDate()->modify('+1 second');
            $subViewCalendars[] = $subViewCalendar;
        }

        return $subViewCalendars;
    }

    /**
     * Checks if a string is a valid timestamp.
     *
     * @param \string $timestampValue
     * @return \boolean
     */
    public function isTimestamp($timestampValue) {
        $check = (is_int($timestampValue) OR is_float($timestampValue))
            ? $timestampValue
            : (string) (int) $timestampValue;
     
        return ($check === $timestampValue)
                AND ((int) $timestampValue <=  PHP_INT_MAX)
                AND ((int) $timestampValue >= ~PHP_INT_MAX);
    }
}
?>