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
 * ForViewHelper
 *
 * @package dm_simplecalendar
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class ForViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

    /**
     * Iterates through elements of $each and renders child nodes
     *
     * @param mixed $each The array or \TYPO3\CMS\Extbase\Persistence\ObjectStorage or character-seperated to iterated over
     * @param string $as The name of the iteration variable
     * @param string $key The name of the variable to store the current array key
     * @param string $glue The character to seperate a given string
     * @param boolean $reverse If enabled, the iterator will start with the last element and proceed reversely
     * @param string $iteration The name of the variable to store iteration information (index, cycle, isFirst, isLast, isEven, isOdd)
     * @param string $repository Repository
     * @return string Rendered string
     * @author Salvatore Eckel <salvatore.eckel@diemedialen.de>
     * @api
     */
    public function render($each, $as, $key = '', $glue = NULL, $reverse = FALSE, $iteration = NULL, $repository = NULL) {
        $output = '';
        if($each === NULL) {
            return '';
        }
        if((is_object($each) && !$each instanceof Traversable) && (!is_string($each))) {
            throw new \TYPO3\CMS\Fluid\Core\ViewHelper\Exception('ForViewHelper only supports arrays and objects implementing Traversable interface or strings' , 1248728393);
        }
        if(!is_string($glue)) {
            throw new \TYPO3\CMS\Fluid\Core\ViewHelper\Exception('ForViewHelper only supports strings for parameter glue ' , 1381938134);
        }
        if($glue !== NULL && !is_string($each)) {
            throw new \TYPO3\CMS\Fluid\Core\ViewHelper\Exception('ForViewHelper only supports strings when glue ist set' , 1381938135);
        }
        if($repository !== NULL) {
            $objectControler = $this->objectManager->get('DieMedialen\DmSimplecalendar\Controller\AbstractController');
            $each = $objectControler->getCategoryRepository()->findManyByUid($each);
        } 
        else {
            if ($glue !== NULL) {
                $each = explode($glue, $each);
            }
        }
        
        if($reverse) {
            if(is_object($each)) {
                $each = iterator_to_array($each);
            }

            $each = array_reverse($each);
        }

        $iterationData = array(
            'index' => 0,
            'cycle' => 1,
            'total' => count($each)
        );
        
        $output = '';
        foreach($each as $keyValue => $singleElement) {
            $this->templateVariableContainer->add($as, $singleElement);
            if($key !== '') {
                $this->templateVariableContainer->add($key, $keyValue);
            }
            if($iteration !== NULL) {
                $iterationData['isFirst'] = $iterationData['cycle'] === 1;
                $iterationData['isLast'] = $iterationData['cycle'] === $iterationData['total'];
                $iterationData['isEven'] = $iterationData['cycle'] % 2 === 0;
                $iterationData['isOdd'] = !$iterationData['isEven'];
                $this->templateVariableContainer->add($iteration, $iterationData);
                $iterationData['index'] ++;
                $iterationData['cycle'] ++;
            }
            $output .= $this->renderChildren();
            $this->templateVariableContainer->remove($as);
            if($key !== '') {
                $this->templateVariableContainer->remove($key);
            }
            if($iteration !== NULL) {
                $this->templateVariableContainer->remove($iteration);
            }
        }
        
        return $output;
    }
}
?>
