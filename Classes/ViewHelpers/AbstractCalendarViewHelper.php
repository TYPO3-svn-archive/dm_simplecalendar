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
 * AbstractCalendarViewHelper
 *
 * @package dm_simplecalendar
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class AbstractCalendarViewHelper extends \TYPO3\CMS\Fluid\ViewHelpers\ForViewHelper {

    /**
     * Render Calendartable.
     * 
     * @param \DieMedialen\DmSimplecalendar\Domain\Model\ViewCalendar $viewCalendar
     * @param \string $as
     * @param \string $key
     * @param \boolean $reverse
     * @param \string $iteration
     * @validate $viewCalendar NotEmpty
     * @validate $as NotEmpty
     * @return \string
     */
    public function render(\DieMedialen\DmSimplecalendar\Domain\Model\ViewCalendar $viewCalendar, $as, $key = '', $reverse = FALSE, $iteration = NULL) {
        
        return self::renderStatic($this->arguments, $this->buildRenderChildrenClosure(), $this->renderingContext);
    }

    /**
     * Call parent render.
     *
     * @param \array $arguments
     * @param \Closure $renderChildrenClosure
     * @param \TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface $renderingContext
     * @return \string
     * @throws \TYPO3\CMS\Fluid\Core\ViewHelper\Exception
     */
    static public function renderStatic(array $arguments, \Closure $renderChildrenClosure, \TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface $renderingContext) {
        $viewCalendar = $arguments['viewCalendar'];
        $arguments['each'] = $viewCalendar->getSubCalendars(static::$subCalendarMode);

        return parent::renderStatic($arguments,  $renderChildrenClosure, $renderingContext);
    }
}
?>