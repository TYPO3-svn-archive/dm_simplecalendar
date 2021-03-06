<?php
namespace DieMedialen\DmSimplecalendar\Domain\Model;

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
 * Category
 *
 * @package dm_simplecalendar
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Category extends \TYPO3\CMS\Extbase\Domain\Model\Category {

    /**
     * title
     *
     * @var \string
     * @validate NotEmpty
     */
    protected $title;

    /**
     * color
     *
     * @var \string
     */
    protected $color;

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
     * @param string $title
     * @return void
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * Returns the color
     *
     * @return \string $color
     */
    public function getColor() {
        return $this->color;
    }

    /**
     * Sets the color
     *
     * @param string $color
     * @return void
     */
    public function setColor($color) {
        $this->color = $color;
    }
}
?>