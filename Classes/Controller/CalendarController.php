<?php
namespace DieMedialen\DmSimplecalendar\Controller;

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
 * CalendarController.
 *
 * @package dm_simplecalendar
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class CalendarController extends AbstractController {
    public static $periodType = 'periodType';

    /**
     * action show
     *
     * @param \string $viewMode
     * @param \int $viewRange
     * @return void
     */
    public function showAction($viewMode = NULL, $viewTimestamp = NULL) {
        /* required line for tempalte switch system */
        $this->view = $this->handleCustomTemplatePaths($this->view, $this->settings);
        $viewCalendar = $this->objectManager->get('DieMedialen\DmSimplecalendar\Domain\Model\ViewCalendar');

        if ($viewMode !== NULL && !empty($viewMode)) {
            $viewCalendar->setMode($viewMode);
        } 
        else {
            if ($this->settings[self::$periodType] !== NULL && !empty($this->settings[self::$periodType])) {
                $viewCalendar->setMode($this->settings[self::$periodType]);
            }
        }

        if ($viewTimestamp !== NULL && !empty($viewTimestamp)) {
            $viewCalendar->setTimestamp($viewTimestamp);
        }
        else {
            $viewCalendar->setTimestamp(time());
        }

        $viewCalendar->setAppointments($this->appointmentRepository->findInCalendar($viewCalendar, $this->settings));
        $viewCalendar->setCategories($this->categoryRepository->findManyByUid($this->settings['categories']));

        $this->view->assign('viewCalendar', $viewCalendar);

        if($this->isDefinedDefaultView()) {
            $this->view->assign('hideBackToCalendarLink', TRUE);
        }
    }

    /**
     * a custom check for exeptions in template
     *
     * @return bool
     */
     private function isDefinedDefaultView() {
        if(is_array($_REQUEST['tx_dmsimplecalendar_simplecalendar'])) {
            if(count($_REQUEST['tx_dmsimplecalendar_simplecalendar']) == 2 && $_REQUEST['tx_dmsimplecalendar_simplecalendar']['action'] == 'show' && $_REQUEST['tx_dmsimplecalendar_simplecalendar']['controller'] = 'Calendar') {
                return TRUE;
            }

            return FALSE;
        }
        
        return TRUE;
    }
}
?>