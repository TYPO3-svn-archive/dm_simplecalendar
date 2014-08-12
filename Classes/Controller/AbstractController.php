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
 * AbstractController.
 * 
 * @package dm_simplecalendar
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class AbstractController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

    /**
     * appointmentRepository
     *
     * @var \DieMedialen\DmSimplecalendar\Domain\Repository\AppointmentRepository
     * @inject
     */
    protected $appointmentRepository;

    /**
     * categoryRepository
     *
     * @var \DieMedialen\DmSimplecalendar\Domain\Repository\CategoryRepository
     * @inject
     */
    protected $categoryRepository;

    /**
     * attachmentRepository
     *
     * @var \DieMedialen\DmSimplecalendar\Domain\Repository\AttachmentRepository
     * @inject
     */
    protected $attachmentRepository;

    /**
     * Setup the timezone and language.
     */
    public function setupTimezoneAndLanguage() {
        setlocale(LC_ALL, 'de_DE');
        date_default_timezone_set('Europe/Berlin');
    }
    
    /**
     * Handle Custom Template Paths
     * 
     * @param \TYPO3\CMS\Fluid\View\TemplateView $view
     * @param \array $settings
     * 
     * @return \TYPO3\CMS\Fluid\View\TemplateView $view
     */
    protected function handleCustomTemplatePaths($view, $settings) {
        /* The Template System will be rewritten, don't worry! */
        $extensionManager = new \TYPO3\CMS\Core\Utility\ExtensionManagementUtility();
        $generalUtility = new \TYPO3\CMS\Core\Utility\GeneralUtility();

        $extPathPrivateResources = 'EXT:dm_simplecalendar/Resources/Private/';

        $customTemplateSettings = array();
        $customTemplateSettings[$extPathPrivateResources . 'Default/'] = array();
        $customTemplateSettings[$extPathPrivateResources . 'Default/']['cssFilePath'] = $extensionManager->siteRelPath($this->request->getControllerExtensionKey()) . "Resources/Public/Css/Default/style.css";
        $customTemplateSettings[$extPathPrivateResources . 'Bootstrap1/'] = array();
        $customTemplateSettings[$extPathPrivateResources . 'Bootstrap1/']['cssFilePath'] = $extensionManager->siteRelPath($this->request->getControllerExtensionKey()) . "Resources/Public/Css/Bootstrap1/style.css";

        if($settings['useCustomTemplates'] != 1) {
            $view->setPartialRootPath($settings['customTemplatePath'] . "Partials/");
            $view->setLayoutRootPath($settings['customTemplatePath'] . "Layouts/");
            $view->setTemplateRootPath($settings['customTemplatePath'] . "Templates/");

            $cssFile = $customTemplateSettings[$settings['customTemplatePath']]['cssFilePath'];

            if (!empty($cssFile) && substr($cssFile, -1) != '/') {
                if (file_exists($generalUtility->getFileAbsFileName($cssFile)) && filesize($generalUtility->getFileAbsFileName($cssFile)) > 0) {

                    $this->response->addAdditionalHeaderData('<link rel="stylesheet" type="text/css" href="' . $cssFile . '" />');
                }
            }            
        }

        return $view;
    }
    
    /**
     * Returns the categoryRepository
     *
     * @return \DieMedialen\DmSimplecalendar\Domain\Repository\CategoryRepository $categoryRepository
     */
    public function getCategoryRepository() {
        return $this->categoryRepository;
    }    
}
?>