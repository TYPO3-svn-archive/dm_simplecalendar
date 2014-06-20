<?php
namespace DieMedialen\DmSimplecalendar\Domain\Repository;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Kai Ratzeburg <hello@kai-ratzeburg.de>
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
 * AppointmentRepository
 *
 * @package dm_simplecalendar
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class AppointmentRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {
    /**
     * Get all appointments from calendar.
     * 
     * @param \DieMedialen\DmSimplecalendar\Domain\Model\ViewCalendar $viewCalendar
     * @param \array $settings
     * @return \array
     */
    public function findInCalendar(\DieMedialen\DmSimplecalendar\Domain\Model\ViewCalendar $viewCalendar, $settings = NULL) {
        $query = $this->createQuery();
        $queryContraints = array();

        //WHERE ('is in shown range' AND ( 'is included uid' OR ('has category uid'  AND 'is not excluded uid') ) )
       if($settings !== NULL && is_array($settings)) {
            // setting vars for shorter code
            $categories = $settings['categories'];
            $excludeEvents = $settings['excludeSelectedEvents'];
            $includeEvents = $settings['includeSelectedEvents'];
            $includeEventsConstraints = array();

            if(!empty($categories)) {
                $categoryUids = explode(",", $categories);
                
                foreach($categoryUids as $categoryUid) {
                    $categoryOrConstraints[] = $query->contains('categories', $categoryUid);
                }
                
                $categoryConstraints = $query->logicalOr($categoryOrConstraints);
            }
            if(!empty($excludeEvents)) {
                $excludeEventsUids = explode(',', $excludeEvents);

                foreach($excludeEventsUids as $excludeEventsUid) {
                    $excludeEventsOrConstraints[] = $query->logicalNot($query->equals('uid', $excludeEventsUid));
                }
                
                $excludeEventsConstraints = $query->logicalAnd($excludeEventsOrConstraints);
            }
            if(!empty($includeEvents)) {

                $includeEventsUids = explode(',', $includeEvents);
                
                foreach($includeEventsUids as $includeEventsUid) {
                    $includeEventsOrConstraints[] = $query->equals('uid', $includeEventsUid);
                }
                
                $includeEventsConstraints = $query->logicalAnd($query->logicalOr($includeEventsOrConstraints));
            }
        }

        if(!empty($includeEvents) && !empty($excludeEvents)) {
            $queryContraints[] = $query->logicalOr(
                $query->logicalAnd(
                    $categoryConstraints,
                    $excludeEventsConstraints
                ),
                $includeEventsConstraints
            );
        } elseif(!empty($includeEvents) && empty($excludeEvents)) {
            $queryContraints[] = $query->logicalOr(
                $query->logicalAnd(
                    $categoryConstraints
                ),
                $includeEventsConstraints
            );
        } elseif(empty($includeEvents) && !empty($excludeEvents)) {
            $queryContraints[] = $query->logicalOr(
                $query->logicalAnd(
                    $categoryConstraints,
                    $excludeEventsConstraints
                )
            );
        } elseif(empty($includeEvents) && empty($excludeEvents)) {
            $queryContraints[] = $query->logicalOr(
                $query->logicalAnd(
                    $categoryConstraints
                )
            );
        }

        $queryContraints[] = $query->logicalOr(
            $query->logicalAnd(
                $query->greaterThanOrEqual('startdate', $viewCalendar->getStartDate()),
                $query->lessThanOrEqual('enddate', $viewCalendar->getEndDate())
            ),
            $query->logicalAnd(
                $query->lessThanOrEqual('startdate', $viewCalendar->getStartDate()),
                $query->lessThanOrEqual('enddate', $viewCalendar->getEndDate())
            ),
            $query->logicalAnd(
                $query->lessThanOrEqual('startdate', $viewCalendar->getStartDate()),
                $query->greaterThanOrEqual('enddate', $viewCalendar->getEndDate())
            ),
            $query->logicalAnd(
                $query->greaterThanOrEqual('startdate', $viewCalendar->getStartDate()),
                $query->greaterThanOrEqual('enddate', $viewCalendar->getEndDate())
            )
        );
        
        $query->matching($query->logicalAnd($queryContraints));

        $query->setOrderings(array('startdate' => \Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING));

        return $query->execute();
    }
}
?>