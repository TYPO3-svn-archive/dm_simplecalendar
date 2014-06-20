<?php
namespace DieMedialen\DmSimplecalendar\ViewHelpers\Link;

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

define('STR_STRING', 'string');

/**
 * ExternalViewHelper.
 * 
 * @package dm_simplecalendar
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class ExternalViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper {

    /**
     * @var string
     */
    protected $tagName = 'a';

    /**
     * Initialize arguments
     *
     * @return void
     * @api
     */
    public function initializeArguments() {
        $this->registerUniversalTagAttributes();
        $this->registerTagAttribute('name', STR_STRING, 'Specifies the name of an anchor');
        $this->registerTagAttribute('rel', STR_STRING, 'Specifies the relationship between the current document and the linked document');
        $this->registerTagAttribute('rev', STR_STRING, 'Specifies the relationship between the linked document and the current document');
        $this->registerTagAttribute('target', STR_STRING, 'Specifies where to open the linked document');
    }

    /**
     * @param string $uri the URI that will be put in the href attribute of the rendered link tag
     * @param boolean $insertHost insert the host in the uri
     * @param string $defaultScheme scheme the href attribute will be prefixed with if specified $uri does not contain a scheme already
     * @return string Rendered link
     * @api
     */
    public function render($uri, $insertHost = FALSE, $defaultScheme = 'http') {
        $scheme = parse_url($uri, PHP_URL_SCHEME);
        if($scheme === NULL && $defaultScheme !== '') {
            if ($insertHost) {
                $uri = $defaultScheme . '://' . substr($_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'], 0, -9) . '/' . $uri;
            } 
            else {
                $uri = $defaultScheme . '://' . $uri;
            }
        }

        $this->tag->addAttribute('href', $uri);
        $this->tag->setContent($this->renderChildren());
        $this->tag->forceClosingTag(TRUE);

        return $this->tag->render();
    }
}
?>