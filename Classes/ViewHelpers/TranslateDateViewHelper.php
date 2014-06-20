<?php
namespace DieMedialen\DmSimplecalendar\ViewHelpers;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Kai Ratzeburg <hello@kai-ratzeburg.de>, Die Medialen
 *  (c) 2014 Salvatore Eckel <salvatore.eckel@diemedialen.de>, Die Medialen
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
 * TranslateDateViewHelper
 *
 * @package dm_simplecalendar
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class TranslateDateViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {
    /**
     * Render Monthname.
     * 
     * @param \DateTime $dateTime
     * @param \int $fullName
     * @param \string $type
     * @return \string
     */
    public function render(\DateTime $dateTime, $fullName, $type) {
        if(empty($type)) {
            return;
        }

        $translationPrefix = '';
        $dateName = '';

        switch($type) {
            case 'month':
                $dateName = $dateTime->format('F');
                $translationPrefix = 'date.month.';
                break;
            case 'week':
                $sonar = 'sonar';
                break;
            case 'day':
                $dateName = $dateTime->format('D');
                $translationPrefix = 'date.weekday.';
                break;
            default:
                break;
        }

        if(!empty($translationPrefix) && !empty($dateName)) {
            $translationKey = $translationPrefix . ($fullName == 1 ? '' : 'short.') . $dateName;
            return \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate($translationKey, 'DmSimplecalendar') . $this->renderChildren();
        }
        else {
            return $this->renderChildren();
        }
    }
}
?>