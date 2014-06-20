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

define('STR_STRING', 'string');

/**
 * ImageViewHelper
 *
 * @package dm_simplecalendar
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class ImageViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper {

    /**
     * @var tslib_cObj
     */
    protected $contentObject;

    /**
     * @var string
     */
    protected $tagName = 'img';

    /**
     * @var t3lib_fe contains a backup of the current $GLOBALS['TSFE'] if used in BE mode
     */
    protected $tsfeBackup;

    /**
     * @var string
     */
    protected $workingDirectoryBackup;

    /**
     * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
     */
    protected $configurationManager;

    /**
     * @param \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager
     * @return void
     */
    public function injectConfigurationManager(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManagerObject) {
        $this->configurationManager = $configurationManagerObject;
        $this->contentObject = $this->configurationManager->getContentObject();
    }

    /**
     * Initialize arguments.
     *
     * @return void
     */
    public function initializeArguments() {
        parent::initializeArguments();
        $this->registerUniversalTagAttributes();
        $this->registerTagAttribute('alt', STR_STRING, 'Specifies an alternate text for an image', TRUE);
        $this->registerTagAttribute('ismap', STR_STRING, 'Specifies an image as a server-side image-map. Rarely used. Look at usemap instead', FALSE);
        $this->registerTagAttribute('longdesc', STR_STRING, 'Specifies the URL to a document that contains a long description of an image', FALSE);
        $this->registerTagAttribute('usemap', STR_STRING, 'Specifies an image as a client-side image-map', FALSE);
    }

    /**
     * Resizes a given image (if required) and renders the respective img tag
     * @see http://typo3.org/documentation/document-library/references/doc_core_tsref/4.2.0/view/1/5/#id4164427
     *
     * @param string $src
     * @param string $width width of the image. This can be a numeric value representing the fixed width of the image in pixels. But you can also perform simple calculations by adding "m" or "c" to the value. See imgResource.width for possible options.
     * @param string $height height of the image. This can be a numeric value representing the fixed height of the image in pixels. But you can also perform simple calculations by adding "m" or "c" to the value. See imgResource.width for possible options.
     * @param integer $minWidth minimum width of the image
     * @param integer $minHeight minimum height of the image
     * @param integer $maxWidth maximum width of the image
     * @param integer $maxHeight maximum height of the image
     *
     * @return string rendered tag.
     */
    public function render($src, $width = NULL, $height = NULL, $minWidth = NULL, $minHeight = NULL, $maxWidth = NULL, $maxHeight = NULL) {
        if(TYPO3_MODE === 'BE') {
            $this->simulateFrontendEnvironment();
        }
        $setup = array(
            'width' => $width,
            'height' => $height,
            'minW' => $minWidth,
            'minH' => $minHeight,
            'maxW' => $maxWidth,
            'maxH' => $maxHeight
        );
        if(TYPO3_MODE === 'BE' && substr($src, 0, 3) === '../') {
            $src = substr($src, 3);
        }
        $imageInfo = $this->contentObject->getImgResource($src, $setup);
        $GLOBALS['TSFE']->lastImageInfo = $imageInfo;
        if(!is_array($imageInfo)) {
            throw new \TYPO3\CMS\Fluid\Core\ViewHelper\Exception('Could not get image resource for "' . htmlspecialchars($src) . '".' , 1253191060);
        }
        $imageInfo[3] = \TYPO3\CMS\Core\Utility\GeneralUtility::png_to_gif_by_imagemagick($imageInfo[3]);
        $GLOBALS['TSFE']->imagesOnPage[] = $imageInfo[3];

        $imageSource = $GLOBALS['TSFE']->absRefPrefix . \TYPO3\CMS\Core\Utility\GeneralUtility::rawUrlEncodeFP($imageInfo[3]);
        if(TYPO3_MODE === 'BE') {
            $imageSource = '../' . $imageSource;
            $this->resetFrontendEnvironment();
        }
        
        if(strlen($imageSource) > 0 || !($imageSource == '')) {
            $this->tag->addAttribute('src', $imageSource);
        } 
        else {
            $this->tag->addAttribute('src', $src);
        }
        $this->tag->addAttribute('width', $imageInfo[0]);
        $this->tag->addAttribute('height', $imageInfo[1]);
        if($this->arguments['title'] === '') {
            $this->tag->addAttribute('title', $this->arguments['alt']);
        }

        return $this->tag->render();
    }

    /**
     * Prepares $GLOBALS['TSFE'] for Backend mode
     * This somewhat hacky work around is currently needed because the getImgResource() function of tslib_cObj relies on those variables to be set
     *
     * @return void
     */
    protected function simulateFrontendEnvironment() {
        $this->tsfeBackup = isset($GLOBALS['TSFE']) ? $GLOBALS['TSFE'] : NULL;
            // set the working directory to the site root
        $this->workingDirectoryBackup = getcwd();
        chdir(PATH_site);

        $typoScriptSetup = $this->configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
        $GLOBALS['TSFE'] = new stdClass();
        $template = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('t3lib_TStemplate');
        $template->tt_track = 0;
        $template->init();
        $template->getFileName_backPath = PATH_site;
        $GLOBALS['TSFE']->tmpl = $template;
        $GLOBALS['TSFE']->tmpl->setup = $typoScriptSetup;
        $GLOBALS['TSFE']->config = $typoScriptSetup;
    }

    /**
     * Resets $GLOBALS['TSFE'] if it was previously changed by simulateFrontendEnvironment()
     *
     * @return void
     * @see simulateFrontendEnvironment()
     */
    protected function resetFrontendEnvironment() {
        $GLOBALS['TSFE'] = $this->tsfeBackup;
        chdir($this->workingDirectoryBackup);
    }
}