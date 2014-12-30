<?php
namespace DieMedialen\DmSimplecalendar\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Salvatore Eckel <salvatore.eckel@diemedialen.de>, Die Medialen GmbH
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
 * AppointmentController
 *
 * @package dm_simplecalendar
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class AppointmentController extends AbstractController {
    const ICAL_DT_FORMAT = 'Ymd\THis\Z';

    /**
     * action show
     *
     * @param \DieMedialen\DmSimplecalendar\Domain\Model\Appointment
     * @return void
     */
    public function showAction(\DieMedialen\DmSimplecalendar\Domain\Model\Appointment $appointment) {
        /* required line for tempalte switch system */
        $this->view = $this->handleCustomTemplatePaths($this->view, $this->settings);
        $this->view->assign('appointment', $appointment);
    }

    /**
     * action icsDownload
     * 
     * @param \DieMedialen\DmSimplecalendar\Domain\Model\Appointment
     * @return void
     */
    protected function icsDownloadAction(\DieMedialen\DmSimplecalendar\Domain\Model\Appointment $appointment) {
        // prepare variables
        $name = $appointment->getTitle();
        $start = $appointment->getStartdate()->getTimestamp();
        $end = $appointment->getEnddate()->getTimestamp();
        $description = strip_tags($appointment->getDescription());
        $description = preg_replace('/([\,;])/','\\\$1', $description);
        $description = htmlspecialchars_decode($description);
        $description = html_entity_decode($description);

        $location = "DE";
        $data = "BEGIN:VCALENDAR
VERSION:2.0
PRODID:http://www.diemedialen.de/
METHOD:PUBLISH
BEGIN:VEVENT
DTSTART:".date(self::ICAL_DT_FORMAT,$start)."
DTEND:".date(self::ICAL_DT_FORMAT,$end)."
LOCATION:".$location."
TRANSP: OPAQUE
SEQUENCE:0
UID:
DTSTAMP:".date(self::ICAL_DT_FORMAT).time()."
SUMMARY:".$name."
DESCRIPTION:".$description."
PRIORITY:1
CLASS:PUBLIC
BEGIN:VALARM
TRIGGER:-PT10080M
ACTION:DISPLAY
DESCRIPTION:Reminder
END:VALARM
END:VEVENT
END:VCALENDAR";
        // set correct headers
        header("Content-type: text/calendar; charset=utf-8");
        header('Content-Disposition: attachment; filename="'.$name.'.ics"');
        Header('Content-Length: '.strlen($data));
        Header('Connection: close');
        echo $data;
        exit;
    }
}
?>