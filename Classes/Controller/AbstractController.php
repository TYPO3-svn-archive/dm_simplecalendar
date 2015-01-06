<?php
namespace DieMedialen\DmSimplecalendar\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Kai Ratzeburg <hello@kai-ratzeburg.de>, Die Medialen GmbH
 *  (c) 2015 Salvatore Eckel <salvatore.eckel@diemedialen.de>, Die Medialen GmbH
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
    private static $designs = array(
        'default' => "EXT:dm_simplecalendar/Resources/Private/",
        'bootstrap1' => "EXT:dm_simplecalendar/Resources/Private/Bootstrap1/"
    );

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
     * Handle Custom Template Paths
     * 
     * @param \TYPO3\CMS\Fluid\View\TemplateView $view
     * @param \array $settings
     * 
     * @return \TYPO3\CMS\Fluid\View\TemplateView $view
     */
    protected function handleCustomTemplatePaths($view, $settings) {
        $designPath = self::$designs[$settings['customTemplatePath']];
        if($settings['useCustomTemplates'] != 1 && !empty($designPath)) {
            $view->setPartialRootPath($designPath . "Partials");
            $view->setLayoutRootPath($designPath . "Layouts");
            $view->setTemplateRootPath($designPath . "Templates");
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