<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'DieMedialen.' . $_EXTKEY,
    'Simplecalendar',
    array(
        'Calendar' => 'show',
        'Appointment' => 'show, icsDownload',
        'FeEdit' => 'newAppointment, createAppointment, editAppointment, newMultipleAppointments, createMultipleAppointments, updateAppointment, deleteAppointment, confirmDeleteAppointment, removeAndDeleteAttachment',
    ),
    // non-cacheable actions
    array(
        'Calendar' => 'show',
        'Appointment' => 'show, icsDownload',
        'FeEdit' => 'newAppointment, createAppointment, editAppointment, newMultipleAppointments, createMultipleAppointments, updateAppointment, deleteAppointment, confirmDeleteAppointment, removeAndDeleteAttachment',
    )
);

$extConfiguration = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]);

if ($extConfiguration['enableDmSimpleCalendarPageTSconfig']) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:dm_simplecalendar/Configuration/TypoScript/pageTSconfig.txt">');
}

?>